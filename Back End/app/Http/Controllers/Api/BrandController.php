<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function allBrand(){
        $brand= Brand::get();
        return response($brand);
    }

    public function topBrand(){
        $brand= Brand::get()->take(6);
        return response($brand);
    }
}
