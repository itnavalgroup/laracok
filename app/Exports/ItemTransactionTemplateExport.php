<?php

namespace App\Exports;

use App\Models\ItemCategory;
use App\Models\Item;
use App\Models\Warehouse;
use App\Models\Company;
use App\Models\Uom;
use App\Models\Packaging;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\NamedRange;

class ItemTransactionTemplateExport implements WithHeadings, WithEvents
{
    protected $isAdmin;

    public function __construct($isAdmin = false)
    {
        $this->isAdmin = $isAdmin;
    }

    public function headings(): array
    {
        return [
            'item_category_code (PILIH DARI DROPDOWN)',
            'item_code (PILIH DARI DROPDOWN)',
            'warehouse (PILIH DARI DROPDOWN)',
            'company (PILIH DARI DROPDOWN)',
            'uom (PILIH DARI DROPDOWN)',
            'packaging (PILIH DARI DROPDOWN)',
            'income (PILIH TITIK UNTUK DESIMAL - TANPA PEMISAH RIBUAN)',
            'outcome (PILIH TITIK UNTUK DESIMAL - TANPA PEMISAH RIBUAN)',
            'transaction_date (ex: 2026-02-26)',
            'user (PILIH DARI DROPDOWN - ADMIN ONLY)',
            'vendor (PILIH DARI DROPDOWN)',
            'police_number',
            'driver_name',
            'so_number',
            'invoice_number',
            'po_number',
            'fob',
            'filename (OPTIONAL)',
            'description'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $spreadsheet = $event->sheet->getDelegate()->getParent();

                // Create a hidden sheet for the dropdown source data
                $dataSheet = $spreadsheet->createSheet();
                $dataSheet->setTitle('DataSources');
                $dataSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

                // --- 1. Populate DataSources ---
                $categories = ItemCategory::where('is_active', 1)->pluck('item_category_code')->toArray();

                // Fetch items grouped by category for dependent dropdown
                $itemsByCategory = Item::join('tbl_item_categories', 'tbl_items.id_item_category', '=', 'tbl_item_categories.id_item_category')
                    ->where('tbl_items.is_active', 1)
                    ->select('tbl_items.item_code', 'tbl_item_categories.item_category_code')
                    ->get()
                    ->groupBy('item_category_code');

                // Warehouse logic (Respect user scope)
                $user = Auth::user();
                if ($user->level === 1 || $user->hasPermission('item_transaction.view.all') || empty($user->id_warehouse)) {
                    $warehouses = Warehouse::pluck('warehouse_name')->toArray();
                } else {
                    $warehouses = Warehouse::where('id_warehouse', $user->id_warehouse)->pluck('warehouse_name')->toArray();
                }

                $companies = Company::pluck('company_name')->toArray();
                $uoms = Uom::pluck('uom')->toArray();
                $packagings = Packaging::pluck('packaging')->toArray();
                $vendors = \App\Models\Vendor::where('is_active', 1)->get()->map(function ($v) {
                    return "[#{$v->id_vendor}] {$v->vendor}";
                })->toArray();
                $users = \App\Models\User::where('is_active', 1)->pluck('name')->toArray();

                $colCategories = 'A';
                $colWarehouses = 'B';
                $colCompanies = 'C';
                $colUoms = 'D';
                $colPackagings = 'E';
                $colUsers = 'F';
                $colVendors = 'G';

                foreach ($categories as $index => $val) {
                    $dataSheet->setCellValue($colCategories . ($index + 1), $val);
                }
                foreach ($warehouses as $index => $val) {
                    $dataSheet->setCellValue($colWarehouses . ($index + 1), $val);
                }
                foreach ($companies as $index => $val) {
                    $dataSheet->setCellValue($colCompanies . ($index + 1), $val);
                }
                foreach ($uoms as $index => $val) {
                    $dataSheet->setCellValue($colUoms . ($index + 1), $val);
                }
                foreach ($packagings as $index => $val) {
                    $dataSheet->setCellValue($colPackagings . ($index + 1), $val);
                }
                foreach ($users as $index => $val) {
                    $dataSheet->setCellValue($colUsers . ($index + 1), $val);
                }
                foreach ($vendors as $index => $val) {
                    $dataSheet->setCellValue($colVendors . ($index + 1), $val);
                }

                // Populate dynamic columns for dependent dropdowns
                $currentColIndex = 8; // Starting from Column H for Categories items
                foreach ($itemsByCategory as $catCode => $itemList) {
                    $colString = Coordinate::stringFromColumnIndex($currentColIndex);
                    foreach ($itemList as $idx => $item) {
                        $dataSheet->setCellValue($colString . ($idx + 1), $item->item_code);
                    }

                    // Sanitize category code for named range (Spaces to underscores, filter non-alphanumeric except period/underscore)
                    $cleanCatCode = preg_replace('/[^A-Za-z0-9._]/', '_', $catCode);
                    // Excel names cannot start with a number
                    if (is_numeric(substr($cleanCatCode, 0, 1))) {
                        $cleanCatCode = '_' . $cleanCatCode;
                    }

                    $rangeValue = "DataSources!\${$colString}\$1:\${$colString}\$" . count($itemList);
                    try {
                        $spreadsheet->addNamedRange(new NamedRange($cleanCatCode, $dataSheet, $rangeValue));
                    } catch (\Exception $e) {
                        // Silently ignore if already exists or invalid
                    }
                    $currentColIndex++;
                }

                // --- 2. Setup Data Validations on Main Sheet ---
                $mainSheet = $event->sheet->getDelegate();

                $this->applyValidation($mainSheet, 'A', 'Categories', "DataSources!\$A$1:\$A$" . (count($categories) ?: 1));

                // Dependent Validation for Item Code (Column B) based on Category (Column A)
                // Use SUBTOTAL/SUBSTITUTE logic to match the sanitized named range if category might have spaces
                $validationB = $mainSheet->getCell('B2')->getDataValidation();
                $validationB->setType(DataValidation::TYPE_LIST);
                $validationB->setErrorStyle(DataValidation::STYLE_STOP);
                $validationB->setAllowBlank(false);
                $validationB->setShowInputMessage(true);
                $validationB->setShowErrorMessage(true);
                $validationB->setShowDropDown(true);
                $validationB->setErrorTitle('Input Error');
                $validationB->setError("Pilih Category terlebih dahulu atau pilih Item dari daftar.");
                $validationB->setPromptTitle("Pilih Item");
                $validationB->setPrompt("Klik dropdown untuk melihat Item berdasarkan Category.");

                // Formula: INDIRECT( sanitization of A2 )
                // For simplicity, we assume Category Code is already mostly valid. 
                // We'll use a formula that attempts to match our sanitization logic.
                $formulaB = '=INDIRECT(SUBSTITUTE(SUBSTITUTE(A2, " ", "_"), "-", "_"))';
                $validationB->setFormula1($formulaB);

                for ($i = 2; $i <= 500; $i++) {
                    $mainSheet->getCell('B' . $i)->setDataValidation(clone $validationB);
                }

                $this->applyValidation($mainSheet, 'C', 'Warehouse', "DataSources!\$B$1:\$B$" . (count($warehouses) ?: 1));
                $this->applyValidation($mainSheet, 'D', 'Company', "DataSources!\$C$1:\$C$" . (count($companies) ?: 1));
                $this->applyValidation($mainSheet, 'E', 'UOM', "DataSources!\$D$1:\$D$" . (count($uoms) ?: 1));
                $this->applyValidation($mainSheet, 'F', 'Packaging', "DataSources!\$E$1:\$E$" . (count($packagings) ?: 1));
                $this->applyValidation($mainSheet, 'J', 'User', "DataSources!\$F$1:\$F$" . (count($users) ?: 1));
                $this->applyValidation($mainSheet, 'K', 'Vendor', "DataSources!\$G$1:\$G$" . (count($vendors) ?: 1));

                $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S'];

                foreach ($columns as $column) {
                    $mainSheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }

    private function applyValidation($sheet, $column, $title, $formula)
    {
        $validation = $sheet->getCell($column . '2')->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_STOP);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Input Error');
        $validation->setError("Harap pilih $title dari daftar yang tersedia di format dropdown.");
        $validation->setPromptTitle("Pilih $title");
        $validation->setPrompt("Klik dropdown untuk memilih $title.");
        $validation->setFormula1($formula);

        for ($i = 2; $i <= 500; $i++) {
            $sheet->getCell($column . $i)->setDataValidation(clone $validation);
        }
    }
}
