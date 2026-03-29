<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorEmail extends Model
{
    use SoftDeletes;
    protected $table = 'tbl_email_vendor';
    protected $primaryKey = 'id_email_vendor';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'id_vendor',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function isUsed()
    {
        return \App\Models\Pr::where('id_email_vendor', $this->id_email_vendor)->exists() ||
            \App\Models\Sr::where('id_email_vendor', $this->id_email_vendor)->exists();
    }
}
