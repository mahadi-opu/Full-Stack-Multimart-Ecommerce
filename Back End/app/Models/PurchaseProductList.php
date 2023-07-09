<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProductList extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_cost',
        'total_vat',
        'total_discount',
        'purchase_code',
        'total_payable_amount',
        'total_paid',
        'total_due',
        'supplier_id',
        'date',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    public function supplierInfo(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function purchaseDetails(){
        return $this->hasOne(PurchaseDetails::class,'purchase_id','id');
    }
    public function purchaseInfo(){
        return $this->hasOne(PurchaseDetails::class,'product_id','id');
    }

}
