<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $table = 'tbl_user_permissions';
    protected $primaryKey = 'id_user_permission';

    protected $fillable = [
        'id_user',
        'id_permission',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'id_permission', 'id_permission');
    }
}
