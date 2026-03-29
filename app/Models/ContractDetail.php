<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractDetail extends Model
{
    use HasFactory;

    protected $table      = 'tbl_contract_detail';
    protected $primaryKey = 'id_contract_detail';
    public    $timestamps = true;

    protected $fillable = [
        'id_contract',
        'id_item_category',
        'id_item',
        'qty',
    ];

    // =========================================================================
    // RELATIONS
    // =========================================================================

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

    // =========================================================================
    // HELPERS
    // =========================================================================

    /**
     * Total qty shipped (sent via IKB) for this contract + item combination.
     * Matches BOTH id_contract AND id_item in tbl_ikb_details.
     */
    public function getShippedQtyAttribute(): float
    {
        return (float) IkbDetail::where('id_contract', $this->id_contract)
            ->where('id_item', $this->id_item)
            ->whereNull('deleted_at')
            ->sum('qty');
    }

    public function getRemainingQtyAttribute(): float
    {
        return $this->qty - $this->shipped_qty;
    }
}
