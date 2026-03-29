<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrDetail extends Model
{
    protected $table = 'tbl_detail_pr';
    protected $primaryKey = 'id_detail_pr';
    public $timestamps = true;

    protected $fillable = [
        'id_pr',
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
        'progresif',
        'gross',
        'is_purchase_items',
        'detail',
        'bl_number',
        'qty',
        'price',
        'dpp_pph',
        'discount',
        'tax1',
        'tax2',
        'ammount',
    ];

    protected $casts = [
        'qty' => 'decimal:4',
        'price' => 'decimal:4',
        'dpp_pph' => 'decimal:4',
        'discount' => 'decimal:4',
        'tax1' => 'decimal:4',
        'tax2' => 'decimal:4',
        'ammount' => 'decimal:4',
    ];

    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'id_uom', 'id_uom');
    }

    public function taxType1()
    {
        return $this->belongsTo(TaxType::class, 'id_tax_type1', 'id_tax_type');
    }

    public function taxSatu()
    {
        return $this->belongsTo(Tax::class, 'id_tax1', 'id_tax');
    }

    public function taxType2()
    {
        return $this->belongsTo(TaxType::class, 'id_tax_type2', 'id_tax_type');
    }

    public function taxDua()
    {
        return $this->belongsTo(Tax::class, 'id_tax2', 'id_tax');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'id_item_category', 'id_item_category');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }
}
