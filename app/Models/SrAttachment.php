<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SrAttachment extends Model
{
    protected $table = 'tbl_attachment_sr';
    protected $primaryKey = 'id_attachment_sr';
    public $timestamps = true;

    protected $fillable = [
        'id_attachment',
        'id_sr',
        'id_user',
        'note',
        'filename',
    ];

    public function sr()
    {
        return $this->belongsTo(Sr::class, 'id_sr', 'id_sr');
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
