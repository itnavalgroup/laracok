<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IkbAttachment extends Model
{
    use HasFactory, SoftDeletes;

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

    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'id_attachment', 'id_attachment');
    }
}
