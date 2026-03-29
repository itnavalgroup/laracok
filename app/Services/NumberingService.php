<?php

namespace App\Services;

use App\Models\Pr;
use App\Models\Sr;
use App\Models\Ikb;
use App\Models\Company;
use App\Models\Departement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NumberingService
{
    /**
     * Generate Next Sequence Number for a specific Model
     */
    public function getNextSequence($modelClass, $idDept, $dateField = 'created_at')
    {
        $currentYear = date('Y');
        
        $table = (new $modelClass)->getTable();

        $lastNumber = DB::table($table)
            ->where('id_departement', $idDept)
            ->whereYear($dateField, $currentYear)
            ->max('number');

        return ($lastNumber ?? 0) + 1;
    }

    /**
     * Format PR Number
     * Format: PR.[Company].[Dept].[YYMM].[XXX]
     */
    public function generatePrNumber($companyName, $deptName, $date, $sequence)
    {
        $dt = Carbon::parse($date);
        $year = $dt->format('y'); // YY
        $month = $dt->format('m'); // MM
        $pad = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return "PR.{$companyName}.{$deptName}.{$year}{$month}.{$pad}";
    }

    /**
     * Format SR Number
     * Format: SR.[Company].[Dept].[YYMM].[XXX]
     */
    public function generateSrNumber($companyName, $deptName, $date, $sequence)
    {
        $dt = Carbon::parse($date);
        $year = $dt->format('y');
        $month = $dt->format('m');
        $pad = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return "SR.{$companyName}.{$deptName}.{$year}{$month}.{$pad}";
    }

    /**
     * Format IKB Number
     * Format: IKB.[Company].[Dept].[YYMM].[XXX]
     */
    public function generateIkbNumber($companyName, $deptName, $date, $sequence)
    {
        $dt = Carbon::parse($date);
        $year = $dt->format('y');
        $month = $dt->format('m');
        $pad = str_pad($sequence, 3, '0', STR_PAD_LEFT);

        return "IKB.{$companyName}.{$deptName}.{$year}{$month}.{$pad}";
    }
}
