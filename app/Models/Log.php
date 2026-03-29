<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_log';
    protected $primaryKey = 'id_log';
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'id_departement',
        'level',
        'log',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }
}
