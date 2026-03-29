<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'tbl_permissions';
    protected $primaryKey = 'id_permission';

    protected $fillable = [
        'permission_name',
        'permission_description',
        'module',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tbl_user_permissions', 'id_permission', 'id_user');
    }
}
