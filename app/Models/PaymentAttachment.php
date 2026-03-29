<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentAttachment extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_attachment_payment';
    protected $primaryKey = 'id_attachment_payment';
    public $timestamps = true;
    
    protected $fillable = [
        'id_doc_type',
        'id_attachment',
        'id_payment',
        'id_user',
        'id_pr',
        'note',
        'filename',
    ];
    
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment', 'id_payment');
    }
    
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'id_attachment', 'id_attachment');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }
}
