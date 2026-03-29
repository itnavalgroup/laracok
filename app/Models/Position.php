<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'tbl_position';
    protected $primaryKey = 'id_position';
    public $timestamps = true;

    protected $fillable = [
        'position',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_position', 'id_position');
    }
}
