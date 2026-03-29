<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrItemTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_pr_item_transactions';
    protected $primaryKey = 'id_pr_item_transaction';
    public $timestamps = true;

    protected $fillable = [
        'id_pr',
        'id_item',
        'id_warehouse',
        'id_user',
        'id_uom',
        'id_packaging',
        'id_departement',
        'id_company',
        'id_doc_type',
        'qty',
        'note',
        'transaction_date',
    ];

    protected $casts = [
        'qty' => 'decimal:4',
        'transaction_date' => 'datetime',
    ];

    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
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
