<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'image',
        'phone',
        'address',
        'available_balance',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];
}
