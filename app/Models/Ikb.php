<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ikb extends Model
{
    protected $table = 'tbl_ikb';
    protected $primaryKey = 'id_ikb';
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'sales',
        'id_warehouse',
        'id_vendor',
        'id_departement',
        'id_company',
        'id_doc_type',
        'id_ikb_transaction_type',
        'number',
        'ikb_number',
        'po_number',
        'so_number',
        'ri_number',
        'sk_number',
        'do_number',
        'batch_number',
        'destination',
        'qr',
        'status',
        'booking_date',
        'stuffing_date',
        'delivery_date',
    ];
    
    protected $casts = [
        'booking_date' => 'datetime',
        'stuffing_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
    public function salesUser()
    {
        return $this->belongsTo(User::class, 'sales', 'id_user');
    }
    
    public function docType()
    {
        return $this->belongsTo(DocType::class, 'id_doc_type', 'id_doc_type');
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement', 'id_departement');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company', 'id_company');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse', 'id_warehouse');
    }
    
    public function transactionType()
    {
        return $this->belongsTo(IkbTransactionType::class, 'id_ikb_transaction_type', 'id_ikb_transaction_type');
    }

    public function details()
    {
        return $this->hasMany(IkbDetail::class, 'id_ikb', 'id_ikb');
    }

    public function attachments()
    {
        return $this->hasMany(AttachmentIkb::class, 'id_ikb', 'id_ikb');
    }

    public function signTransactions()
    {
        return $this->hasMany(SignTransaction::class, 'id_ikb', 'id_ikb');
    }

    /**
     * Apply visibility scope based on user permissions
     */
    public function scopeVisibleTo($query, User $user)
    {
        // Admin (Level 1) or ikb.view.all sees all
        if ($user->level === 1 || $user->hasPermission('ikb.view.all')) {
            return $query;
        }

        return $query->where(function($q) use ($user) {
            // Base condition: Own IKBs (Requestor or Sales)
            $q->where('id_user', $user->id_user)
              ->orWhere('sales', $user->id_user);

            // Permission: View Department IKBs (Their own department)
            if ($user->hasPermission('ikb.view.dept') && $user->id_departement) {
                $q->orWhere('id_departement', $user->id_departement);
            }

            // Permission: View Warehouse IKBs (Their own warehouse)
            if ($user->hasPermission('ikb.view.warehouse') && $user->id_warehouse) {
                $q->orWhere('id_warehouse', $user->id_warehouse);
            }

            // Permission: View Subordinate IKBs
            if ($user->hasPermission('ikb.view.subordinate')) {
                $subordinateIds = $user->subordinates()->pluck('id_user')->toArray();
                if (!empty($subordinateIds)) {
                    $q->orWhereIn('id_user', $subordinateIds)
                      ->orWhereIn('sales', $subordinateIds);
                }
            }
        });
    }
}
