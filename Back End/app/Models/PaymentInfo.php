<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable = [
        'payment_type',
        'sell_id',
        'total_paid',
        'tnx_id',
        'card_brand',
        'card_last_digit',
        'payment_inv_link',
        'created_at',
    ];
}
