<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_branch';
    protected $primaryKey = 'id_branch';
    public $timestamps = true;

    protected $fillable = [
        'branch',
        'branch_address',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_branch', 'id_branch');
    }
}
