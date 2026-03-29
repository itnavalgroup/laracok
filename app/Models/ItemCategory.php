<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_item_categories';
    protected $primaryKey = 'id_item_category';
    public $timestamps = true;

    protected $fillable = [
        'item_category_code',
        'id_user',
        'item_category',
        'is_active',
    ];

    /**
     * Get the user who created the item category.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
