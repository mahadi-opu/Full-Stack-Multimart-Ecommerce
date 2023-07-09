<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        "sell_id",
        "email",
        "name",
        "shipping_phone",
        "shipping_address",
        "shipping_city",
        "shipping_country",
        "shipping_zip",
        "shipping_state",
        "billing_first_name",
        "billing_last_name",
        "billing_email",
        "billing_phone",
        "billing_address",
        "billing_city",
        "billing_country",
        "billing_zip",
        "billing_state",
        "note",
    ];
}
