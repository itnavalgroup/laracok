<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Uom extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_uoms';
    protected $primaryKey = 'id_uom';
    public $timestamps = true;
    
    protected $fillable = [
        'uom',
        'qty_kg',
    ];
    
    protected $casts = [
        'qty_kg' => 'decimal:4',
    ];
}
