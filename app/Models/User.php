<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_employee',
        'supervisor',
        'name',
        'nik',
        'npwp',
        'level',
        'password',
        'photo',
        'phone',
        'id_company',
        'id_branch',
        'id_departement',
        'id_branch',
        'id_position',
        'id_warehouse',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'level'    => 'integer',
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function level_detail()
    {
        return $this->belongsTo(Level::class, 'level', 'level');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_position', 'id_position');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch', 'id_branch');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'tbl_user_permissions', 'id_user', 'id_permission');
    }
    public function emails()
    {
        return $this->hasMany(UserEmail::class, 'id_user', 'id_user');
    }

    public function primary_email()
    {
        return $this->hasOne(UserEmail::class, 'id_user', 'id_user')->latest();
    }

    public function bankAccounts()
    {
        return $this->hasMany(UserBankAccount::class, 'id_user', 'id_user');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'supervisor', 'id_user');
    }

    public function boss()
    {
        return $this->belongsTo(User::class, 'supervisor', 'id_user');
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->level == 1) {
            return true;
        }

        return $this->permissions()->where('permission_name', $permission)->exists();
    }

    public function isGlobalAdmin(): bool
    {
        // Admin (Level 1) or has permission to view all
        return $this->level === 1 || $this->hasPermission('user.view.all');
    }

    public function canEditUser(User $targetUser): bool
    {
        // Admin can edit all
        if ($this->level === 1) return true;

        // Has global edit permission
        if ($this->hasPermission('user.edit') && $this->hasPermission('user.view.all')) return true;

        // If has permission to edit and view dept, check department match
        if ($this->hasPermission('user.edit') && $this->hasPermission('user.view.dept')) {
            return $this->id_departement === $targetUser->id_departement;
        }

        // If has permission to edit and view subordinate, check supervisor match
        if ($this->hasPermission('user.edit') && $this->hasPermission('user.view.subordinate')) {
            return $targetUser->supervisor === $this->id_user;
        }

        return false;
    }
}
