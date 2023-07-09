<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class ReportController extends Controller
{
    public function sellReport(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Sell Report';

        if (strtotime($request->startdate) && strtotime($request->enddate)) {
            $from = date('Y-m-d', strtotime($request->startdate));
            $to = date('Y-m-d 23:59:59', strtotime($request->enddate));
            $sellProduct = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
                ->whereBetween('sell_details.created_at', [$from, $to])
                ->select('products.*', DB::raw("SUM(sell_details.sale_quantity) as total_sell"))
                ->groupBy('sell_details.product_id')
                ->orderBy('total_sell', 'DESC')
                ->get();
        }else{
            $sellProduct = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
                ->select('products.*', DB::raw("SUM(sell_details.sale_quantity) as total_sell"))
                ->groupBy('sell_details.product_id')
                ->orderBy('total_sell', 'DESC')
                ->get();
        }




        return view('adminPanel.report.sell_report')->with(compact('sellProduct', 'common_data'));
    }

    public function sellProfitReport(Request $request)
    {
        $common_data = new Array_();
        $common_data->title = 'Sell Profit Report';
        if (strtotime($request->startdate) && strtotime($request->enddate)) {
            $from = date('Y-m-d', strtotime($request->startdate));
            $to = date('Y-m-d 23:59:59', strtotime($request->enddate));

            $sellProduct = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
                ->whereBetween('sell_details.created_at', [$from, $to])
                ->select('products.*',
                    DB::raw("SUM(sell_details.sale_quantity) as total_sell"),
                    DB::raw("SUM(sell_details.unit_product_cost) as total_cost"),
                    DB::raw("SUM(sell_details.unit_sell_price) as total_sell_price"),
                )
                ->groupBy('sell_details.product_id')
                ->orderBy('total_sell_price', 'DESC')
                ->get();
        } else {
            $sellProduct = DB::table("sell_details")->join('products', 'sell_details.product_id', '=', 'products.id')
                ->select('products.*',
                    DB::raw("SUM(sell_details.sale_quantity) as total_sell"),
                    DB::raw("SUM(sell_details.unit_product_cost) as total_cost"),
                    DB::raw("SUM(sell_details.unit_sell_price) as total_sell_price"),
                )
                ->groupBy('sell_details.product_id')
                ->orderBy('total_sell_price', 'DESC')
                ->get();
        }
//        return $sellProduct;

        return view('adminPanel.report.profit_report')->with(compact('sellProduct', 'common_data'));


    }
}


