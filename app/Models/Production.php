<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Production extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_productions';
    protected $primaryKey = 'id_production';

    protected $fillable = [
        'production_number',
        'id_user',
        'id_warehouse',
        'id_departement',
        'id_company',
        'production_date',
        'status',
        'description',
        'processed_by',
        'finished_by',
        'canceled_by',
        'cancel_reason',
        'finished_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by', 'id_user');
    }

    public function finishedBy()
    {
        return $this->belongsTo(User::class, 'finished_by', 'id_user');
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by', 'id_user');
    }

    public function materials()
    {
        return $this->hasMany(ProductionMaterial::class, 'id_production', 'id_production');
    }

    public function results()
    {
        return $this->hasMany(ProductionResult::class, 'id_production', 'id_production');
    }

    public function attachments()
    {
        return $this->hasMany(ProductionAttachment::class, 'id_production', 'id_production');
    }

    /**
     * Apply visibility scope based on user permissions
     */
    public function scopeVisibleTo($query, User $user)
    {
        if ($user->level === 1 || $user->hasPermission('production.view.all')) {
            return $query;
        }

        return $query->where(function($q) use ($user) {
            $q->where('id_user', $user->id_user);

            if ($user->hasPermission('production.view.dept') && $user->id_departement) {
                $q->orWhere('id_departement', $user->id_departement);
            }

            if ($user->hasPermission('production.view.warehouse') && $user->id_warehouse) {
                $q->orWhere('id_warehouse', $user->id_warehouse);
            }
        });
    }
}
