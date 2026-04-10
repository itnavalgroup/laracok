<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionNote extends Model
{
    use HasFactory;

    protected $table = 'tbl_production_notes';
    protected $primaryKey = 'id_production_note';

    protected $fillable = [
        'id_production',
        'id_user',
        'note_type',
        'note',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'id_production', 'id_production');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
