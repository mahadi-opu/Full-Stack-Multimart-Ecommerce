<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id",
        "invoice_id",
        "sell_type",
        "sell_by",
        "bank_id",
        "shipping_cost",
        "total_vat_amount",
        "total_discount",
        "total_payable_amount",
        "total_paid",
        "total_due",
        "order_status",
        "payment_type",
    ];
    public function customer()
    {
        return $this->belongsTo(PosCustomer::class, 'customer_id', 'id');
    }
    public function sellDetail(){
        return $this->hasMany(Sell_details::class,'sell_id','id');
    }

    public function orderAddress(){
        return $this->hasOne(SellOrderAddress::class,'sell_id','id');
    }

    public function paymentInfo(){
        return $this->hasOne(PaymentInfo::class,'sell_id','id');
    }

}
