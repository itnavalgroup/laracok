<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PaymentRequestExport implements FromArray, WithHeadings, WithEvents, WithStyles, WithColumnFormatting
{
    protected $prs;
    protected $mergeData = [];

    public function __construct($prs)
    {
        $this->prs = $prs;
    }

    public function array(): array
    {
        $rows = [];
        $currentRow = 3; // Data starts below the 2-Tier Header (Row 3)

        foreach ($this->prs as $pr) {
            $docTypeStr = $pr->docType ? $pr->docType->doc_type : 'UNKNOWN';
            
            // Status PR
            $prStatusLabels = [
                '0'=>'Draft', '1'=>'Pending Dept Sign', '2'=>'Pending Director Sign',
                '3'=>'Pending Accounting Sign', '4'=>'Pending Finance Sign', '5'=>'Pending SPV Finance Sign',
                '6'=>'Pending CFO Sign', '7'=>'Pending Payment', '8'=>'Payment Parsial',
                '9'=>'Pending Receipt Parsial', '10'=>'Pending Receipt', '11'=>'Paid',
                '12'=>'Revision', '13'=>'Rejected', '14'=>'Pending Director Sign Payment',
                '15'=>'Pending Manager Sign Payment'
            ];
            $statusPr = $prStatusLabels[$pr->status] ?? $pr->status;

            // Payments PR Multi-line text & calculations
            $prPaymentsText = "";
            $totalPrPayment = 0;
            if ($pr->payments && $pr->payments->count() > 0) {
                foreach ($pr->payments as $payment) {
                    $dateStr = $payment->date ? date('Y-m-d', strtotime($payment->date)) : '';
                    $prPaymentsText .= "{$dateStr} - Rp " . number_format($payment->grand_total, 0, ',', '.') . "\n";
                    $totalPrPayment += $payment->grand_total;
                }
            }
            
            $prTotalAmount = $pr->total_amount ?? 0;
            $pendingPr = $prTotalAmount - $totalPrPayment;
            
            if ($totalPrPayment > 0 || $prPaymentsText !== "") {
                $prPaymentsText .= "Total: Rp " . number_format($totalPrPayment, 0, ',', '.') . "\n";
                $prPaymentsText .= "Pending: Rp " . number_format($pendingPr, 0, ',', '.');
            } else {
                $prPaymentsText = "-";
            }

            // Settlement Report variables initialization
            $srSubject = '-';
            $statusSr = '-';
            $srSettlementDate = '-';
            $srAmount = 0;
            $srPaymentsText = "-";
            
            $srDetailsList = collect();

            if ($pr->id_doc_type == 2 && $pr->srs && $pr->srs->count() > 0) {
                $sr = $pr->srs->first(); // Mengambil master Advance SR
                
                $srSubject = $sr->subject ?? '-';
                $srSettlementDate = $sr->created_at ? $sr->created_at->format('Y-m-d') : '-';
                $statusSr = $sr->status_label ?? '-'; // Using accessor status_label from Sr Model

                // Kumpulkan semua detail SR
                foreach ($pr->srs as $srobj) {
                    if ($srobj->details) {
                        foreach($srobj->details as $d) {
                            $srDetailsList->push($d);
                            $srAmount += $d->ammount ?? 0;
                        }
                    }
                }
                
                $totalSrPayment = 0;
                $srPaymentsTextBuilder = "";
                if ($sr->payments && $sr->payments->count() > 0) {
                    foreach ($sr->payments as $payment) {
                        $dateStr = $payment->date ? date('Y-m-d', strtotime($payment->date)) : '';
                        $srPaymentsTextBuilder .= "{$dateStr} - Rp " . number_format($payment->grand_total, 0, ',', '.') . "\n";
                        $totalSrPayment += $payment->grand_total;
                    }
                }
                
                $srPending = $srAmount - $totalSrPayment;
                if ($totalSrPayment > 0 || $srPaymentsTextBuilder !== "") {
                    $srPaymentsText = $srPaymentsTextBuilder . "Total: Rp " . number_format($totalSrPayment, 0, ',', '.') . "\n";
                    $srPaymentsText .= "Pending: Rp " . number_format($srPending, 0, ',', '.');
                } else {
                    $srPaymentsText = "-";
                }
            }

            // Calculate rows needed: maximum of PR Details or SR Details count
            $prDetailsCount = $pr->details ? $pr->details->count() : 0;
            $srDetailsCount = $srDetailsList->count();
            $maxRows = max(1, max($prDetailsCount, $srDetailsCount));
            
            $startRowForThisPr = $currentRow;

            for ($i = 0; $i < $maxRows; $i++) {
                $prDetail = ($pr->details && isset($pr->details[$i])) ? $pr->details[$i] : null;
                $srDetail = isset($srDetailsList[$i]) ? $srDetailsList[$i] : null;

                $row = [
                    $docTypeStr,
                    $pr->pr_number ?? 'DRAFT',
                    $pr->payment_due_date ? $pr->payment_due_date->format('Y-m-d') : '-',
                    $pr->est_settlement_date ? $pr->est_settlement_date->format('Y-m-d') : '-',
                    $statusPr,
                    $pr->subject,
                    $pr->user->name ?? '-',
                    $pr->departement->departement ?? '-',
                    $pr->company->company_name ?? '-',
                    $pr->vendor ? ($pr->vendor->vendor_name ?: $pr->vendor->vendor) : '-',
                    $pr->po_number ?? '-',
                    
                    // PR Detail - Individual Row Data
                    $prDetail ? ($prDetail->detail ?? '-') : '-',
                    $prDetail ? ($prDetail->qty ?? null) : null,
                    $prDetail ? ($prDetail->ammount ?? null) : null,

                    $prTotalAmount,
                    $prPaymentsText,
                    
                    // SR Master - Merged Data
                    $srSubject,
                    $statusSr,
                    $srSettlementDate,

                    // SR Detail - Individual Row Data
                    $srDetail ? ($srDetail->detail ?? '-') : '-',
                    $srDetail ? ($srDetail->qty ?? null) : null,
                    $srDetail ? ($srDetail->ammount ?? null) : null,

                    $srAmount,
                    $srPaymentsText,
                ];

                $rows[] = $row;
                $currentRow++;
            }

            // Record merge regions for this PR if it spans multiple detail rows
            if ($maxRows > 1) {
                $endRow = $startRowForThisPr + $maxRows - 1;
                // Merged Master PR & SR columns
                $mergedCols = [
                    'A','B','C','D','E','F','G','H','I','J','K', // PR Master
                    'O','P',                                     // PR Summary/Payments
                    'Q','R','S',                                 // SR Master
                    'W','X'                                      // SR Summary/Payments
                ];
                foreach ($mergedCols as $col) {
                    $this->mergeData[] = "{$col}{$startRowForThisPr}:{$col}{$endRow}";
                }
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            // Row 1: Group Headers
            [
                'Payment Request', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                'Settlement Report', '', '', '', '', '', '', ''
            ],
            // Row 2: Actual Columns
            [
                'Doc Type', 'PR Number', 'Payment Due Date', 'Est Settlement Date', 'Status PR', 'Subject', 
                'Requestor', 'Departement', 'Company', 'Vendor', 'PO Number', 
                'Description PR', 'Detail Qty', 'Detail Total Amount', 
                'Total PR Amount', 'PR Payments', 
                'Subject SR', 'Status SR', 'Settlement Date', 
                'Description SR', 'Detail Qty SR', 'Detail Total Amount SR', 
                'Total Amount SR', 'SR Payments'
            ]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'N' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Detail Total Amount
            'O' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Total PR Amount
            'V' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Detail Total Amount SR
            'W' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1, // Total Amount SR
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 2-Tier Header Alignment & Font
                $sheet->getStyle('A1:X2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A1:X2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle('A1:X2')->getFont()->setBold(true);

                // Background Colors for Headers
                $sheet->getStyle('A1:P1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF92D050'); // Hijau PR
                $sheet->getStyle('Q1:X1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFC000'); // Kuning/Oranye SR
                $sheet->getStyle('A2:X2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFE5E5E5'); // Abu-abu Header Kolom

                // Alignment Top for all content rows
                $cellRange = $sheet->calculateWorksheetDimension();
                $sheet->getStyle('A3:' . explode(':', $cellRange)[1])->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

                // Set Wrap Text & Specific Widths for Long Columns
                $longCols = ['F', 'L', 'P', 'Q', 'T', 'X']; // Subject, Desc PR, PR Pay, Subj SR, Desc SR, SR Pay
                foreach ($longCols as $lc) {
                    $sheet->getStyle($lc . ':' . $lc)->getAlignment()->setWrapText(true);
                }

                foreach (range('A', 'X') as $col) {
                    if (in_array($col, $longCols)) {
                        $sheet->getColumnDimension($col)->setWidth(35); // Ukuran rapi tidak melebar tak terhingga
                    } else {
                        $sheet->getColumnDimension($col)->setAutoSize(true); // Fit to content
                    }
                }

                // Execute vertical merges dynamically from loop
                if (method_exists($sheet, 'setMergeCells')) {
                    $mergeArray = [];
                    $mergeArray['A1:P1'] = 'A1:P1';
                    $mergeArray['Q1:X1'] = 'Q1:X1';
                    foreach ($this->mergeData as $range) {
                        $mergeArray[$range] = $range;
                    }
                    $sheet->setMergeCells($mergeArray);
                } else {
                    $sheet->mergeCells('A1:P1');
                    $sheet->mergeCells('Q1:X1');
                    foreach ($this->mergeData as $mergeRange) {
                        $sheet->mergeCells($mergeRange);
                    }
                }
            },
        ];
    }
}
