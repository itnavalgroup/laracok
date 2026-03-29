<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_attachment';
    protected $primaryKey = 'id_attachment';
    public $timestamps = true;

    protected $fillable = [
        'id_departement',
        'id_user',
        'attachment',
    ];

    /**
     * Get the department associated with the attachment.
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    /**
     * Get the user who created the attachment category.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
