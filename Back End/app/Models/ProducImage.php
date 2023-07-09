<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProducImage extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'image',
    ];
}
