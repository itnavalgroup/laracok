<?php

namespace App\Exports;

use App\Models\ItemCategory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\NamedRange;

class ItemTemplateExport implements WithHeadings, WithEvents
{
    public function headings(): array
    {
        return [
            'item_code',
            'item_name',
            'category_code',
            'description'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $spreadsheet = $event->sheet->getDelegate()->getParent();

                // --- 1. Create a separate sheet for categories ---
                $categorySheet = $spreadsheet->createSheet();
                $categorySheet->setTitle('Categories');
                $categorySheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

                // Populate categories
                $categories = ItemCategory::where('is_active', 1)->pluck('item_category_code')->toArray();
                foreach ($categories as $index => $code) {
                    $categorySheet->setCellValue('A' . ($index + 1), $code);
                }

                // Reference range
                $rowCount = count($categories);
                $range = 'Categories!$A$1:$A$' . ($rowCount > 0 ? $rowCount : 1);

                // --- 2. Setup Data Validation on Main Sheet ---
                $mainSheet = $event->sheet->getDelegate();

                $validation = $mainSheet->getCell('C2')->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_STOP);
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input Error');
                $validation->setError('Harap pilih kategori dari daftar yang tersedia.');
                $validation->setPromptTitle('Pilih Kategori');
                $validation->setPrompt('Silakan pilih salah satu kode kategori barang.');
                $validation->setFormula1($range);

                // Apply to column C (C2 to C500)
                for ($i = 2; $i <= 500; $i++) {
                    $mainSheet->getCell("C$i")->setDataValidation(clone $validation);
                }
            },
        ];
    }
}
