<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SrDetail extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_detail_sr';
    protected $primaryKey = 'id_detail_sr';
    public $timestamps = true;

    protected $fillable = [
        'id_pr',
        'id_sr',
        'id_user',
        'id_departement',
        'id_doc_type',
        'id_uom',
        'id_tax_type1',
        'id_tax1',
        'id_tax_type2',
        'id_tax2',
        'id_item_category',
        'id_item',
        'id_warehouse',
        'detail',
        'bl_number',
        'dpp_pph',
        'qty',
        'price',
        'discount',
        'tax1',
        'tax2',
        'progresif',
        'gross',
        'is_purchase_items',
        'ammount',
    ];

    protected $casts = [
        'qty' => 'decimal:4',
        'price' => 'decimal:4',
        'discount' => 'decimal:4',
        'tax1' => 'decimal:4',
        'tax2' => 'decimal:4',
        'dpp_pph' => 'decimal:4',
        'ammount' => 'decimal:4',
        'progresif' => 'integer',
        'gross' => 'integer',
        'is_purchase_items' => 'integer'
    ];

    public function sr()
    {
        return $this->belongsTo(Sr::class, 'id_sr', 'id_sr');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'id_uom', 'id_uom');
    }

    public function taxType1()
    {
        return $this->belongsTo(TaxType::class, 'id_tax_type1', 'id_tax_type');
    }

    public function taxType2()
    {
        return $this->belongsTo(TaxType::class, 'id_tax_type2', 'id_tax_type');
    }

    public function taxSatu()
    {
        return $this->belongsTo(Tax::class, 'id_tax1', 'id_tax');
    }

    public function taxDua()
    {
        return $this->belongsTo(Tax::class, 'id_tax2', 'id_tax');
    }

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'id_item_category', 'id_item_category');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }
}
