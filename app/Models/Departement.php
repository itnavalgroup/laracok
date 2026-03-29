<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_departement';
    protected $primaryKey = 'id_departement';

    protected $fillable = [
        'departement',
    ];
}
