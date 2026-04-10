<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductionMaterial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_production_materials';
    protected $primaryKey = 'id_production_material';

    protected $fillable = [
        'id_production',
        'id_item',
        'id_item_category',
        'id_uom',
        'id_packaging',
        'qty',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'id_production', 'id_production');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'id_item_category', 'id_item_category');
    }

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'id_uom', 'id_uom');
    }

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'id_packaging', 'id_packaging');
    }
}
