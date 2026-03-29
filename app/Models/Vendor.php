<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'tbl_vendor';
    protected $primaryKey = 'id_vendor';
    public $timestamps = true;

    protected $fillable = [
        'id_departement',
        'id_user',
        'vendor',
        'npwp',
        'nik',
        'file_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function emails()
    {
        return $this->hasMany(VendorEmail::class, 'id_vendor', 'id_vendor');
    }

    public function bankAccounts()
    {
        return $this->hasMany(VendorBankAccount::class, 'id_vendor', 'id_vendor');
    }

    public function prs()
    {
        return $this->hasMany(Pr::class, 'id_vendor', 'id_vendor');
    }
}
