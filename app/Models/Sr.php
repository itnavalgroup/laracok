<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sr extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_sr';
    protected $primaryKey = 'id_sr';
    public $timestamps = true;

    protected $fillable = [
        'id_pr',
        'id_doc_type',
        'id_cost_type',
        'id_cost_category',
        'id_branch',
        'id_loan',
        'id_user',
        'id_departement',
        'id_company',
        'id_vendor',
        'id_email_vendor',
        'id_norek_vendor',
        'id_email_user',
        'id_warehouse',
        'subject',
        'no_invoice',
        'additional_discount',
        'payment_method',
        'nama_bank',
        'nama_penerima',
        'norek',
        'qr',
        'status',
    ];

    protected $casts = [
        'additional_discount' => 'decimal:4',
        'status'              => 'integer',
        'payment_method'      => 'integer',
    ];

    // =========================================================================
    // RELATIONSHIPS
    // =========================================================================

    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'id_currency', 'id_currency');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function docType()
    {
        return $this->belongsTo(DocType::class, 'id_doc_type', 'id_doc_type');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'id_branch', 'id_branch');
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

    public function emailVendor()
    {
        return $this->belongsTo(VendorEmail::class, 'id_email_vendor', 'id_email_vendor');
    }

    public function norekVendor()
    {
        return $this->belongsTo(NorekVendor::class, 'id_norek_vendor', 'id_norek_vendor');
    }

    public function emailUser()
    {
        return $this->belongsTo(UserEmail::class, 'id_email_user', 'id_email_user');
    }

    public function details()
    {
        return $this->hasMany(SrDetail::class, 'id_sr', 'id_sr');
    }

    public function attachments()
    {
        return $this->hasMany(SrAttachment::class, 'id_sr', 'id_sr');
    }

    public function signTransactions()
    {
        return $this->hasMany(SignTransaction::class, 'id_pr', 'id_pr')
            ->where('id_doc_type', $this->id_doc_type ?? 3);
    }

    /**
     * Payments yang merujuk SR ini (by doc_type SR)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'id_pr', 'id_pr')
            ->where('id_doc_type', $this->id_doc_type ?? 3);
    }

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Filter visibility based on sr.* permissions
     */
    public function scopeVisibleTo($query, User $user)
    {
        // Admin sees all
        if ($user->level === 1) {
            return $query;
        }

        if ($user->hasPermission('sr.view.all')) {
            return $query;
        }

        if ($user->hasPermission('sr.view.dept')) {
            return $query->where('id_departement', $user->id_departement);
        }

        if ($user->hasPermission('sr.view.subordinate')) {
            $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
            $subordinateIds[] = $user->id_user;
            return $query->whereIn('id_user', $subordinateIds);
        }

        // Approvers can see all SR
        $approverPerms = [
            'sr.approve.step1', 'sr.approve.step2', 'sr.approve.step3',
            'sr.approve.step4', 'sr.approve.step5', 'sr.approve.step6',
            'sr_payment.view',
        ];
        foreach ($approverPerms as $perm) {
            if ($user->hasPermission($perm)) {
                return $query;
            }
        }

        // Default: own SR only
        return $query->where('id_user', $user->id_user);
    }

    public function scopeFilterByPermission($query)
    {
        return $this->scopeVisibleTo($query, auth()->user());
    }

    // =========================================================================
    // ACCESSORS
    // =========================================================================

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            null, 0 => 'Draft',
            1       => 'Pending Dept Sign',
            2       => 'Pending Director Sign',
            3       => 'Pending Accounting Sign',
            4       => 'Pending Finance Sign',
            5       => 'Pending SPV Finance Sign',
            6       => 'Pending CFO Sign',
            7       => 'Pending Payment',
            8       => 'Payment Parsial',
            9       => 'Pending Receipt Parsial',
            10      => 'Pending Receipt',
            11      => 'Paid / Selesai',
            12      => 'Revision',
            13      => 'Rejected',
            default => 'Unknown',
        };
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            null, 0           => 'secondary',
            1, 2, 3, 4, 5, 6 => 'warning',
            7, 8, 9, 10       => 'info',
            11                => 'success',
            12                => 'primary',
            13                => 'danger',
            default           => 'dark',
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        $color = $this->status_badge_color;
        $label = $this->status_label;
        $style = $color === 'warning' ? ' style="color:#000;"' : '';
        return "<span class=\"badge bg-{$color}\"{$style}>{$label}</span>";
    }
}
