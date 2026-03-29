<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_currency';
    protected $primaryKey = 'id_currency';
    public $timestamps = true;

    protected $fillable = [
        'country',
        'code',
        'symbol',
    ];
}
