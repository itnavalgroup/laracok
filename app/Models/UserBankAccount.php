<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    protected $table = 'tbl_norek_user';
    protected $primaryKey = 'id_norek_user';
    public $timestamps = true;
    
    protected $fillable = [
        'nama_bank',
        'nama_penerima',
        'norek',
        'id_user',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
