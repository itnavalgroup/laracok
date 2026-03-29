<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkbTransactionType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_ikb_transaction_types';
    protected $primaryKey = 'id_ikb_transaction_type';
    public $timestamps = true;

    protected $fillable = [
        'transaction_type',
        'is_active',
    ];

    public function ikbs()
    {
        return $this->hasMany(Ikb::class, 'id_ikb_transaction_type', 'id_ikb_transaction_type');
    }
}
