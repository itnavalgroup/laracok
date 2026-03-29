<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentIkb extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_attachment_ikb';
    protected $primaryKey = 'id_attachment_ikb';
    public $timestamps = true;

    protected $fillable = [
        'id_ikb',
        'id_attachment',
        'id_user',
        'note',
        'filename',
    ];

    public function ikb()
    {
        return $this->belongsTo(Ikb::class, 'id_ikb', 'id_ikb');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function type()
    {
        return $this->belongsTo(Attachment::class, 'id_attachment', 'id_attachment');
    }
}
