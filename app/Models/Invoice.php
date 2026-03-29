<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_invoice';
    protected $primaryKey = 'id_invoice';
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'id_departement',
        'id_company',
        'id_vendor',
        'id_doc_type',
        'id_pr',
        'id_norek_vendor',
        'nama_bank',
        'nama_penerima',
        'norek',
        'truck',
        'invoice_date',
        'invoice_number',
        'delivery_date',
        'file_name',
    ];
    
    protected $casts = [
        'invoice_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];
    
    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }
}
