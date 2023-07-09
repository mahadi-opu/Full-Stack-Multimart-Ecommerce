<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function getCompanyInfo(){
      $companyInfo=  CompanyInfo::first();
      return response()->json($companyInfo);
    }
}
