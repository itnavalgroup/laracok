<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_cost_types';
    protected $primaryKey = 'id_cost_type';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_cost_category',
        'cost_type',
        'cost_document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function category()
    {
        return $this->belongsTo(CostCategory::class, 'id_cost_category', 'id_cost_category');
    }
}
