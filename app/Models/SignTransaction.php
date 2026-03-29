<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SignTransaction extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_sign_transaction';
    protected $primaryKey = 'id_sign_transaction';
    public $timestamps = true;

    protected $fillable = [
        'id_pr',
        'id_ikb',
        'id_sign_flow',
        'id_user',
        'id_doc_type',
        'status',
        'signature_file',
        'reject_reason',
        'director_reason',
    ];

    // Relationships
    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }

    public function ikb()
    {
        return $this->belongsTo(Ikb::class, 'id_ikb', 'id_ikb');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function signFlow()
    {
        return $this->belongsTo(SignFlow::class, 'id_sign_flow', 'id_sign_flow');
    }
}
