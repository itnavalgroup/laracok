<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'tbl_levels';
    protected $primaryKey = 'id_level';
    public $timestamps = true;

    protected $fillable = [
        'level',
        'level_name',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'level', 'level');
    }
}
