<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_tax';
    protected $primaryKey = 'id_tax';
    public $timestamps = true;

    protected $fillable = [
        'id_tax_type',
        'tax',
        'tax_persen',
        'tax_description',
        'status',
    ];

    /**
     * Get the tax type.
     */
    public function taxType()
    {
        return $this->belongsTo(TaxType::class, 'id_tax_type', 'id_tax_type');
    }
}
