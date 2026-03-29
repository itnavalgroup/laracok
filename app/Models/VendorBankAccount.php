<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorBankAccount extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_norek_vendor';
    protected $primaryKey = 'id_norek_vendor';
    public $timestamps = true;

    protected $fillable = [
        'nama_bank',
        'nama_penerima',
        'norek',
        'id_vendor',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function isUsed()
    {
        return \App\Models\Pr::where('id_norek_vendor', $this->id_norek_vendor)->exists() ||
            \App\Models\Sr::where('id_norek_vendor', $this->id_norek_vendor)->exists() ||
            \App\Models\Invoice::where('id_norek_vendor', $this->id_norek_vendor)->exists() ||
            \App\Models\Payment::where('id_norek_vendor', $this->id_norek_vendor)->exists();
    }
}
