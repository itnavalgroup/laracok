<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_tax_types';
    protected $primaryKey = 'id_tax_type';
    public $timestamps = true;

    protected $fillable = [
        'tax_type',
        'tax_type_description',
    ];

    /**
     * Get the taxes for this type.
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class, 'id_tax_type', 'id_tax_type');
    }
}
