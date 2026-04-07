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
        'filename',
        'file_path',
        'description',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'id_production', 'id_production');
    }

    public function getUrlAttribute()
    {
        return \Illuminate\Support\Facades\Storage::url($this->file_path);
    }
}
