<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sell_id',
        'unit_product_cost',
        'unit_sell_price',
        'unit_vat',
        'sale_quantity',
        'total_discount',
        'total_payable_amount',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    public function productInfo(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function sellInfo(){
        return $this->belongsTo(Sell::class,'sell_id','id');
    }
}
