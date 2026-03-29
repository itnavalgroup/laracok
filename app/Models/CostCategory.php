<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_cost_categories';
    protected $primaryKey = 'id_cost_category';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'cost_category',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function costTypes()
    {
        return $this->hasMany(CostType::class, 'id_cost_category', 'id_cost_category');
    }
}
