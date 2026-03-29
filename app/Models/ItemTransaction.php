<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_item_transactions';
    protected $primaryKey = 'id_item_transaction';
    public $timestamps = true;

    protected $fillable = [
        'id_item',
        'id_item_category',
        'id_warehouse',
        'id_company',
        'id_user',
        'id_departement',
        'id_uom',
        'id_packaging',
        'id_sr',
        'id_pr',
        'id_doc_type',
        'transaction_code',
        'income',
        'outcome',
        'transaction_date',
        'description',
        'id_vendor',
        'police_number',
        'driver_name',
        'so_number',
        'invoice_number',
        'po_number',
        'fob',
        'filename',
    ];

    protected $casts = [
        'income' => 'decimal:4',
        'outcome' => 'decimal:4',
        'transaction_date' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'id_uom', 'id_uom');
    }

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'id_packaging', 'id_packaging');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'id_item_category', 'id_item_category');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
}
