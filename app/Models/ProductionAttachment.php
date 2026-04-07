<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionAttachment extends Model
{
    use HasFactory;

    protected $table = 'tbl_production_attachments';
    protected $primaryKey = 'id_production_attachment';

    protected $fillable = [
        'id_production',
        'id_attachment',
        'id_user',
        'note',
        'filename',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'id_production', 'id_production');
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
