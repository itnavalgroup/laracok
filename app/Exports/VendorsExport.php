<?php

namespace App\Exports;

use App\Models\Vendor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VendorsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Vendor::with(['departement', 'creator', 'emails', 'bankAccounts'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Vendor Name',
            'NPWP',
            'NIK',
            'Department',
            'Creator',
            'Emails',
            'Bank Accounts',
            'Created At'
        ];
    }

    public function map($vendor): array
    {
        $emails = $vendor->emails->pluck('email')->implode(', ');
        $banks = $vendor->bankAccounts->map(function ($b) {
            return "{$b->nama_bank}: {$b->norek} ({$b->nama_penerima})";
        })->implode(' | ');

        return [
            $vendor->id_vendor,
            $vendor->vendor,
            $vendor->npwp ? decrypt_legacy($vendor->npwp) : '',
            $vendor->nik ? decrypt_legacy($vendor->nik) : '',
            $vendor->departement->departement ?? 'Global',
            $vendor->creator->name ?? '',
            $emails,
            $banks,
            $vendor->created_at->format('d/m/Y H:i')
        ];
    }
}
