<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_logo',
        'facebook_link',
        'youtube_link',
        'twitter_link',
        'company_address',
        'about_us',
        'refund_policy',
        'shipping_policy',
        'privacy_policy',
        'terms_condition',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];
}
