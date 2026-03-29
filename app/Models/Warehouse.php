<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_warehouse';
    protected $primaryKey = 'id_warehouse';
    public $timestamps = true;

    protected $fillable = [
        'warehouse_name',
        'address',
        'id_user',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'integer',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function items()
    {
        return $this->hasMany(ItemTransaction::class, 'id_warehouse', 'id_warehouse');
    }
}
