<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Packaging extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_packagings';
    protected $primaryKey = 'id_packaging';
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'id_departement',
        'packaging',
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
