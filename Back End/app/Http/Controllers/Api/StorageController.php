<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function countryList(){
        $country_list=countryList();
        return response()->json($country_list);
    }
    public function divisionList(){
        $division_list=Division::get();
        return response()->json($division_list);
    }
    public function districtList(Request $request){

       $divisionList= District::where('division_id',$request->divisionId)->get();
        return response()->json($divisionList);
    }
}
