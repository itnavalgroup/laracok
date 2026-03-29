<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_doc_types';
    protected $primaryKey = 'id_doc_type';
    public $timestamps = true;

    protected $fillable = [
        'doc_type',
    ];

    /**
     * Get the PRs for the document type.
     */
    public function prs()
    {
        return $this->hasMany(Pr::class, 'id_doc_type', 'id_doc_type');
    }

    /**
     * Get the SRs for the document type.
     */
    public function srs()
    {
        return $this->hasMany(Sr::class, 'id_doc_type', 'id_doc_type');
    }
}
