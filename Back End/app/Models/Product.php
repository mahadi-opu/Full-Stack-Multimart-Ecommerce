<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'image_path',
        'supplier_id',
        'code',
        'color',
        'size',
        'brand_id',
        'current_sale_price',
        'current_purchase_cost',
        'current_wholesale_price',
        'wholesale_minimum_qty',
        'previous_wholesale_price',
        'previous_sale_price',
        'previous_purchase_cost',
        'available_quantity',
        'discount_type',
        'discount',
        'unit_type',
        'description',
        'is_popular',
        'is_trending',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    function productSubcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'subcategory_id', 'id');
    }

    function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
