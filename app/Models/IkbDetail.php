<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkbDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_ikb_details';
    protected $primaryKey = 'id_ikb_detail';
    public $timestamps = true;

    protected $fillable = [
        'id_ikb',
        'id_item_category',
        'id_item',
        'id_uom',
        'id_packaging',
        'id_contract',
        'qty',
    ];

    public function ikb()
    {
        return $this->belongsTo(Ikb::class, 'id_ikb', 'id_ikb');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'id_contract', 'id_contract');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }
    
    public function itemCategory()
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
