<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShippingBillingAddress extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'shipping_address',
        'shipping_phone',
        'shipping_city',
        'shipping_country',
        'shipping_zip',
        'shipping_state',
        'billing_address',
        'billing_phone',
        'billing_city',
        'billing_country',
        'billing_zip',
        'billing_state',
        'billing_first_name',
        'billing_last_name',
        'billing_email',
        'billing_phone',
        'note',
    ];
}
