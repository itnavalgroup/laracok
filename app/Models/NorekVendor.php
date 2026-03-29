<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NorekVendor extends Model
{
    protected $table = 'tbl_norek_vendor';
    protected $primaryKey = 'id_norek_vendor';
    public $timestamps = true;

    protected $fillable = [
        'id_vendor',
        'nama_bank',
        'nama_penerima',
        'norek',
        'is_active',
        'id_user',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
}
