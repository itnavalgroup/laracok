<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_items';
    protected $primaryKey = 'id_item';
    public $timestamps = true;

    protected $fillable = [
        'item_name',
        'item_code',
        'description',
        'id_item_category',
        'is_active',
        // 'id_uom', // Removed from table
        // 'price',
        // 'stock',
        // 'min_stock',
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'id_item_category', 'id_item_category');
    }

    public function transactions()
    {
        return $this->hasMany(ItemTransaction::class, 'id_item', 'id_item');
    }
}
