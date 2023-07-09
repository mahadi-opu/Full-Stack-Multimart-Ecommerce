<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;


    protected $fillable = [
        'purchase_id',
        'product_id',
        'unit_cost',
        'total_qty',
        'total_cost',
        'total_vat',
        'total_discount',
        'purchase_payable_amount',
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

    public function productInfo()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
