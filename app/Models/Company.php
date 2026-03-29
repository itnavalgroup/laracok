<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_company';
    protected $primaryKey = 'id_company';
    public $timestamps = true;

    protected $fillable = [
        'company_name',
        'company',
        'logo',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class, 'id_company', 'id_company');
    }

    public function prs()
    {
        return $this->hasMany(Pr::class, 'id_company', 'id_company');
    }

    public function srs()
    {
        return $this->hasMany(Sr::class, 'id_company', 'id_company');
    }

    public function ikbs()
    {
        return $this->hasMany(Ikb::class, 'id_company', 'id_company');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id_company', 'id_company');
    }

    /**
     * Return only the filename without path
     */
    public function getLogoAttribute($value)
    {
        return $value ? basename($value) : null;
    }
}
