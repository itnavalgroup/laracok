<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $table      = 'tbl_contract';
    protected $primaryKey = 'id_contract';
    public    $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_company',
        'id_departement',
        'id_attachment',
        'contract_number',
        'description',
        'file_name',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];

    // =========================================================================
    // RELATIONS
    // =========================================================================

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function details()
    {
        return $this->hasMany(ContractDetail::class, 'id_contract', 'id_contract');
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Scope visibility: admin | dept | subordinate | own
     */
    public function scopeVisibleTo($query, $user)
    {
        if ($user->level === 1 || $user->hasPermission('contract.view')) {
            return $query;
        }

        $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
        $deptSubIds     = array_unique(array_merge([$user->id_user], $subordinateIds));

        if ($user->hasPermission('contract.view.dept') && $user->id_departement) {
            return $query->where(function ($q) use ($user, $deptSubIds) {
                $q->where('tbl_contract.id_departement', $user->id_departement)
                  ->orWhereIn('tbl_contract.id_user', $deptSubIds);
            });
        }

        if ($user->hasPermission('contract.view.subordinate')) {
            return $query->whereIn('tbl_contract.id_user', $deptSubIds);
        }

        // Default: only own
        return $query->where('tbl_contract.id_user', $user->id_user);
    }
}
