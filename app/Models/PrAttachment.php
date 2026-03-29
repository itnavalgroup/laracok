<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrAttachment extends Model
{
    protected $table = 'tbl_attachment_pr';
    protected $primaryKey = 'id_attachment_pr';
    public $timestamps = true;
    
    protected $fillable = [
        'id_pr',
        'id_attachment',
        'id_user',
        'note',
        'filename',
    ];
    
    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }
    
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'id_attachment', 'id_attachment');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
