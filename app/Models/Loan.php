<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'tbl_loans';
    protected $primaryKey = 'id_loan';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'loan',
    ];

    /**
     * Get the user who created the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the PRs for the loan.
     */
    public function prs()
    {
        return $this->hasMany(Pr::class, 'id_loan', 'id_loan');
    }

    /**
     * Get the SRs for the loan.
     */
    public function srs()
    {
        return $this->hasMany(Sr::class, 'id_loan', 'id_loan');
    }
}
