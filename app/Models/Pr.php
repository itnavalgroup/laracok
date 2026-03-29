<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NorekVendor;

class Pr extends Model
{
    protected $table = 'tbl_pr';
    protected $primaryKey = 'id_pr';
    public $timestamps = true;

    protected $fillable = [
        'id_doc_type',
        'id_departement',
        'id_cost_type',
        'id_cost_category',
        'id_branch',
        'id_loan',
        'id_user',
        'id_company',
        'id_vendor',
        'id_email_vendor',
        'id_norek_vendor',
        'id_email_user',
        'id_warehouse',
        'id_currency',
        'number',
        'subject',
        'no_invoice',
        'pr_number',
        'additional_discount',
        'nama_bank',
        'nama_penerima',
        'norek',
        'qr',
        'status',
        'payment_type_pr',
        'po_number',
        'payment_method',
        'payment_due_date',
        'est_settlement_date',
    ];

    protected $casts = [
        'additional_discount' => 'decimal:4',
        'payment_due_date' => 'datetime',
        'est_settlement_date' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function norek_vendor()
    {
        return $this->belongsTo(NorekVendor::class, 'id_norek_vendor', 'id_norek_vendor');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch', 'id_branch');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'id_currency', 'id_currency');
    }

    public function docType()
    {
        return $this->belongsTo(DocType::class, 'id_doc_type', 'id_doc_type');
    }

    public function costCategory()
    {
        return $this->belongsTo(CostCategory::class, 'id_cost_category', 'id_cost_category');
    }

    public function costType()
    {
        return $this->belongsTo(CostType::class, 'id_cost_type', 'id_cost_type');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_loan', 'id_loan');
    }

    public function emailUser()
    {
        return $this->belongsTo(UserEmail::class, 'id_email_user', 'id_email_user');
    }

    public function emailVendor()
    {
        return $this->belongsTo(VendorEmail::class, 'id_email_vendor', 'id_email_vendor');
    }

    public function details()
    {
        return $this->hasMany(PrDetail::class, 'id_pr', 'id_pr');
    }

    public function signTransactions()
    {
        return $this->hasMany(SignTransaction::class, 'id_pr', 'id_pr');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_pr', 'id_pr');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id_pr', 'id_pr');
    }

    public function attachmentPrs()
    {
        return $this->hasMany(PrAttachment::class, 'id_pr', 'id_pr');
    }

    public function srs()
    {
        return $this->hasMany(Sr::class, 'id_pr', 'id_pr');
    }

    // Helper methods
    public function isDraft()
    {
        return $this->status === 0;
    }

    public function isSubmitted()
    {
        return $this->status === 1;
    }

    public function isDeptApproved()
    {
        return $this->status === 2;
    }

    public function isDirectorApproved()
    {
        return $this->status === 3;
    }

    /**
     * Apply visibility scope based on user permissions
     */
    public function scopeVisibleTo($query, User $user)
    {
        // 1. Admin (Level 1) sees all
        if ($user->level === 1) {
            return $query;
        }

        // 2. Permission: View ALL PRs
        if ($user->hasPermission('pr.view.all')) {
            return $query;
        }

        // 3. Permission: View Department PRs
        if ($user->hasPermission('pr.view.dept')) {
            return $query->where('id_departement', $user->id_departement);
        }

        // 4. Permission: View Subordinate PRs
        if ($user->hasPermission('pr.view.subordinate') || $user->isSupervisor()) {
            // Get IDs of subordinates
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            $subordinateIds[] = $user->id_user; // Include self
            return $query->whereIn('id_user', $subordinateIds);
        }

        // 5. Default: View Own PRs Only
        return $query->where('id_user', $user->id_user);
    }
}
