<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'tbl_payment';
    protected $primaryKey = 'id_payment';
    public $timestamps = true;

    protected $fillable = [
        'id_doc_type',
        'id_pr',
        'id_cost_type',
        'id_cost_category',
        'id_user',
        'id_departement',
        'id_branch',
        'id_company',
        'id_vendor',
        'payment_description',
        'payment_type',
        'payment_method',
        'id_norek_vendor',
        'nama_bank',
        'nama_penerima',
        'norek',
        'ammount',
        'additional',
        'grand_total',
        'status',
        'filename',
        'reason',
        'payment_date',
    ];

    protected $casts = [
        'ammount' => 'decimal:4',
        'additional' => 'decimal:4',
        'grand_total' => 'decimal:4',
        'payment_date' => 'datetime',
    ];

    public function pr()
    {
        return $this->belongsTo(Pr::class, 'id_pr', 'id_pr');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function attachments()
    {
        return $this->hasMany(PaymentAttachment::class, 'id_payment', 'id_payment');
    }
}
