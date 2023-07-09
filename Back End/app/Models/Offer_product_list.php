<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_product_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'offer_id',
        'max_quantity',
        'total_sell_quantity',
        'offer_type',
        'offer_amount',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];
    public function offerInfo(){
        return $this->belongsTo(offer::class,'offer_id','id');
    }
    public function productInfo(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
