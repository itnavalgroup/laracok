<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class SignFlow extends Model
{
    use SoftDeletes;
    
    protected $table = 'tbl_sign_flow';
    protected $primaryKey = 'id_sign_flow';
    public $timestamps = true;

    protected $fillable = [
        'id_doc_type',
        'step_order',
        'required',
        'level',
        'description',
    ];

    public function signTransactions()
    {
        return $this->hasMany(SignTransaction::class, 'id_sign_flow', 'id_sign_flow');
    }
}
