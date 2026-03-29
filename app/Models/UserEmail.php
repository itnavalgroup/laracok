<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmail extends Model
{
    protected $table = 'tbl_email_user';
    protected $primaryKey = 'id_email_user';
    public $timestamps = true;
    
    protected $fillable = [
        'email',
        'id_user',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
