<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IkbType extends Model
{
    protected $table = 'tbl_ikb_types';
    protected $primaryKey = 'id_ikb_type';
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'id_dept',
        'ikb_type',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_dept', 'id_departement');
    }
    
    public function ikbs()
    {
        return $this->hasMany(Ikb::class, 'id_ikb_type', 'id_ikb_type');
    }
}
