<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable=[
        'name',
        'image',
        'note',
        'is_popular',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];
    protected $appends = ['category_icon'];

    public function getCategoryIconAttribute()
    {
        if($this->image){
            return $this->image;
        }else{
            return "storage/category_icons/empty2.png";
        }

    }

    public function subcategory(){
        return $this->hasMany(ProductSubCategory::class,'category_id','id');
    }

}
