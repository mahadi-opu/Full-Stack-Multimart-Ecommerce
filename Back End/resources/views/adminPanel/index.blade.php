@extends('adminPanel.layout.layout')
<style>
    i.bx.bx-dots-horizontal-rounded.font-22.text-option {
        display: none;
    }

    li.list-group-item.d-flex.bg-transparent.justify-content-between.align-items-center {
        height: 49px;
    }
</style>

@section('main_content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Orders</p>
                                <h4 class="my-1 text-info">{{$totalOrder}}</h4>
                                <p class="mb-0 font-13">from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Revenue</p>
                                <h4 class="my-1 text-danger">{{$sell->total_sell_price-$sell->total_cost}}</h4>
                                <p class="mb-0 font-13">from last week</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Product Item</p>
                                <h4 class="my-1 text-success">{{$productItem}}</h4>
                                <p class="mb-0 font-13">Active Product</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Customers</p>
                                <h4 class="my-1 text-warning">{{$customer}}</h4>
                                <p class="mb-0 font-13">Active Customer</p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Recent Orders</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Photo</th>
                                    <th>Product ID</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Shipping</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lastOrder as $orderList)
                                    <tr>
                                        <td>{{strlen($orderList->productInfo->name)>20?substr($orderList->productInfo->name,0,20).'...':$orderList->productInfo->name}}</td>
                                        <td><img src="{{asset($orderList->productInfo->image_path)}}" class="product-img-2" alt="product img"></td>
                                        <td>#{{$orderList->sellInfo->invoice_id}}</td>
                                        <td>
                                            @if($orderList->sellInfo->order_status<6)
                                                <span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>

                                            @else
                                                <span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span>
                                            @endif


                                        </td>
                                        <td>{{round($orderList->sellInfo->total_payable_amount)}}</td>
                                        <td>{{ date('d-m-Y',strtotime($orderList->sellInfo->date))  }}</td>
                                        <td><div class="progress" style="height: 6px;">
                                                @if($orderList->sellInfo->order_status<6)
                                                    <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                                                @else
                                                    <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                                                @endif

                                            </div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

{{--                <div class="card radius-10">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Sales Overview</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">--}}
{{--                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>--}}
{{--                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>--}}
{{--                        </div>--}}
{{--                        <div class="chart-container-1">--}}
{{--                            <canvas id="chart1"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">24.15M</h5>--}}
{{--                                <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">12:38</h5>--}}
{{--                                <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3">--}}
{{--                                <h5 class="mb-0">639.82</h5>--}}
{{--                                <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Best Sell Products</h6>
                            </div>
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($sellProductList as $product)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$product->name}} <span class="badge bg-success rounded-pill">{{$product->total_sell}}</span>
                            </li>
                        @endforeach
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Jeans <span class="badge bg-success rounded-pill">1</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">T-Shirts <span class="badge bg-danger rounded-pill">10</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Shoes <span class="badge bg-primary rounded-pill">65</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Lingerie <span class="badge bg-warning text-dark rounded-pill">14</span>--}}
{{--                        </li>--}}
                    </ul>
                </div>
            </div>
        </div><!--end row-->




{{--        <div class="row">--}}
{{--            <div class="col-12 col-lg-7 col-xl-8 d-flex">--}}
{{--                <div class="card radius-10 w-100">--}}
{{--                    <div class="card-header bg-transparent">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Recent Orders</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-lg-7 col-xl-8 border-end">--}}
{{--                                <div id="geographic-map-2"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-5 col-xl-4">--}}

{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span class="float-end">70%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 70%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-ca me-1"></i> Canada <span class="float-end">65%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 65%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-gb me-1"></i> England <span class="float-end">60%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 60%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-au me-1"></i> Australia <span class="float-end">55%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 55%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mb-4">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-in me-1"></i> India <span class="float-end">50%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" style="width: 50%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="mb-0">--}}
{{--                                    <p class="mb-2"><i class="flag-icon flag-icon-cn me-1"></i> China <span class="float-end">45%</span></p>--}}
{{--                                    <div class="progress" style="height: 7px;">--}}
{{--                                        <div class="progress-bar bg-dark progress-bar-striped" role="progressbar" style="width: 45%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-12 col-lg-5 col-xl-4 d-flex">--}}
{{--                <div class="card w-100 radius-10">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card radius-10 border shadow-none">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <div>--}}
{{--                                        <p class="mb-0 text-secondary">Total Likes</p>--}}
{{--                                        <h4 class="my-1">45.6M</h4>--}}
{{--                                        <p class="mb-0 font-13">+6.2% from last week</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="widgets-icons-2 bg-gradient-cosmic text-white ms-auto"><i class='bx bxs-heart-circle'></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card radius-10 border shadow-none">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <div>--}}
{{--                                        <p class="mb-0 text-secondary">Comments</p>--}}
{{--                                        <h4 class="my-1">25.6K</h4>--}}
{{--                                        <p class="mb-0 font-13">+3.7% from last week</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="widgets-icons-2 bg-gradient-ibiza text-white ms-auto"><i class='bx bxs-comment-detail'></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card radius-10 mb-0 border shadow-none">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <div>--}}
{{--                                        <p class="mb-0 text-secondary">Total Shares</p>--}}
{{--                                        <h4 class="my-1">85.4M</h4>--}}
{{--                                        <p class="mb-0 font-13">+4.6% from last week</p>--}}
{{--                                    </div>--}}
{{--                                    <div class="widgets-icons-2 bg-gradient-kyoto text-dark ms-auto"><i class='bx bxs-share-alt'></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div><!--end row-->--}}

{{--        <div class="row row-cols-1 row-cols-lg-3">--}}
{{--            <div class="col d-flex">--}}
{{--                <div class="card radius-10 w-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="font-weight-bold mb-1 text-secondary">Weekly Revenue</p>--}}
{{--                        <div class="d-flex align-items-center mb-4">--}}
{{--                            <div>--}}
{{--                                <h4 class="mb-0">$89,540</h4>--}}
{{--                            </div>--}}
{{--                            <div class="">--}}
{{--                                <p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4% <i class="bx bxs-up-arrow-alt mr-2"></i>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="chart-container-0">--}}
{{--                            <canvas id="chart3"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col d-flex">--}}
{{--                <div class="card radius-10 w-100">--}}
{{--                    <div class="card-header bg-transparent">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Orders Summary</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="chart-container-1">--}}
{{--                            <canvas id="chart4"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <ul class="list-group list-group-flush">--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Completed <span class="badge bg-gradient-quepal rounded-pill">25</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Pending <span class="badge bg-gradient-ibiza rounded-pill">10</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Process <span class="badge bg-gradient-deepblue rounded-pill">65</span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col d-flex">--}}
{{--                <div class="card radius-10 w-100">--}}
{{--                    <div class="card-header bg-transparent">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div>--}}
{{--                                <h6 class="mb-0">Top Selling Categories</h6>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown ms-auto">--}}
{{--                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>--}}
{{--                                </a>--}}
{{--                                <ul class="dropdown-menu">--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Action</a>--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <hr class="dropdown-divider">--}}
{{--                                    </li>--}}
{{--                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="chart-container-0">--}}
{{--                            <canvas id="chart5"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row row-group border-top g-0">--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3 text-center">--}}
{{--                                <h4 class="mb-0 text-danger">$45,216</h4>--}}
{{--                                <p class="mb-0">Clothing</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="p-3 text-center">--}}
{{--                                <h4 class="mb-0 text-success">$68,154</h4>--}}
{{--                                <p class="mb-0">Electronic</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div><!--end row-->--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!--end row-->--}}

    </div>
@endsection

@section('css_plugins')
@endsection
@section('js_plugins')
@endsection
@section('js')
    <script>
        $(function () {
        	"use strict";
        	// chart 1
        	var ctx = document.getElementById('chart1').getContext('2d');
        	var myChart = new Chart(ctx, {
        		type: 'line',
        		data: {
        			labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        			datasets: [{
        				label: 'Google',
        				data: [6, 20, 14, 12, 17, 8, 10],
        				backgroundColor: "transparent",
        				borderColor: "#0d6efd",
        				pointRadius: "0",
        				borderWidth: 4
        			}, {
        				label: 'Facebook',
        				data: [5, 30, 16, 23, 8, 14, 11],
        				backgroundColor: "transparent",
        				borderColor: "#f41127",
        				pointRadius: "0",
        				borderWidth: 4
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: true,
        				labels: {
        					fontColor: '#585757',
        					boxWidth: 40
        				}
        			},
        			tooltips: {
        				enabled: false
        			},
        			scales: {
        				xAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}],
        				yAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}]
        			}
        		}
        	});
        	// chart 2
        	var ctx = document.getElementById("chart2").getContext('2d');
        	var myChart = new Chart(ctx, {
        		type: 'bar',
        		data: {
        			labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        			datasets: [{
        				label: 'Google',
        				data: [13, 8, 20, 4, 18, 29, 25],
        				barPercentage: .5,
        				backgroundColor: "#0d6efd"
        			}, {
        				label: 'Facebook',
        				data: [31, 20, 6, 16, 21, 4, 11],
        				barPercentage: .5,
        				backgroundColor: "#f41127"
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: true,
        				labels: {
        					fontColor: '#585757',
        					boxWidth: 40
        				}
        			},
        			tooltips: {
        				enabled: true
        			},
        			scales: {
        				xAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}],
        				yAxes: [{
        					ticks: {
        						beginAtZero: true,
        						fontColor: '#585757'
        					},
        					gridLines: {
        						display: true,
        						color: "rgba(0, 0, 0, 0.07)"
        					},
        				}]
        			}
        		}
        	});
        	// chart 3
        	new Chart(document.getElementById("chart3"), {
        		type: 'pie',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 4
        	new Chart(document.getElementById("chart4"), {
        		type: 'radar',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "1950",
        				fill: true,
        				backgroundColor: "rgb(13 110 253 / 23%)",
        				borderColor: "#0d6efd",
        				pointBorderColor: "#fff",
        				pointBackgroundColor: "rgba(179,181,198,1)",
        				data: [8.77, 55.61, 21.69, 6.62, 6.82]
        			}, {
        				label: "2050",
        				fill: true,
        				backgroundColor: "rgba(255,99,132,0.2)",
        				borderColor: "rgba(255,99,132,1)",
        				pointBorderColor: "#fff",
        				pointBackgroundColor: "rgba(255,99,132,1)",
        				pointBorderColor: "#fff",
        				data: [25.48, 54.16, 7.61, 8.06, 4.45]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Distribution in % of world population'
        			}
        		}
        	});
        	// chart 5
        	new Chart(document.getElementById("chart5"), {
        		type: 'polarArea',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 6
        	new Chart(document.getElementById("chart6"), {
        		type: 'doughnut',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 7
        	new Chart(document.getElementById("chart7"), {
        		type: 'horizontalBar',
        		data: {
        			labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        			datasets: [{
        				label: "Population (millions)",
        				backgroundColor: ["#0d6efd", "#212529", "#17a00e", "#f41127", "#ffc107"],
        				data: [2478, 5267, 734, 784, 433]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			legend: {
        				display: false
        			},
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			}
        		}
        	});
        	// chart 8
        	new Chart(document.getElementById("chart8"), {
        		type: 'bar',
        		data: {
        			labels: ["1900", "1950", "1999", "2050"],
        			datasets: [{
        				label: "Africa",
        				backgroundColor: "#0d6efd",
        				data: [133, 221, 783, 2478]
        			}, {
        				label: "Europe",
        				backgroundColor: "#f41127",
        				data: [408, 547, 675, 734]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Population growth (millions)'
        			}
        		}
        	});
        	// chart 9
        	new Chart(document.getElementById("chart9"), {
        		type: 'bar',
        		data: {
        			labels: ["1900", "1950", "1999", "2050"],
        			datasets: [{
        				label: "Europe",
        				type: "line",
        				borderColor: "#673ab7",
        				data: [408, 547, 675, 734],
        				fill: false
        			}, {
        				label: "Africa",
        				type: "line",
        				borderColor: "#f02769",
        				data: [133, 221, 783, 2478],
        				fill: false
        			}, {
        				label: "Europe",
        				type: "bar",
        				backgroundColor: "rgba(0,0,0,0.2)",
        				data: [408, 547, 675, 734],
        			}, {
        				label: "Africa",
        				type: "bar",
        				backgroundColor: "rgba(0,0,0,0.2)",
        				backgroundColorHover: "#3e95cd",
        				data: [133, 221, 783, 2478]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Population growth (millions): Europe & Africa'
        			},
        			legend: {
        				display: false
        			}
        		}
        	});
        	// chart 10
        	new Chart(document.getElementById("chart10"), {
        		type: 'bubble',
        		data: {
        			labels: "Africa",
        			datasets: [{
        				label: ["China"],
        				backgroundColor: "#17a00e",
        				borderColor: "#17a00e",
        				data: [{
        					x: 21269017,
        					y: 5.245,
        					r: 15
        				}]
        			}, {
        				label: ["Denmark"],
        				backgroundColor: "#ffc107",
        				borderColor: "#ffc107",
        				data: [{
        					x: 258702,
        					y: 7.526,
        					r: 10
        				}]
        			}, {
        				label: ["Germany"],
        				backgroundColor: "#17a00e",
        				borderColor: "#17a00e",
        				data: [{
        					x: 3979083,
        					y: 6.994,
        					r: 15
        				}]
        			}, {
        				label: ["Japan"],
        				backgroundColor: "#f41127",
        				borderColor: "#f41127",
        				data: [{
        					x: 4931877,
        					y: 5.921,
        					r: 15
        				}]
        			}]
        		},
        		options: {
        			maintainAspectRatio: false,
        			title: {
        				display: true,
        				text: 'Predicted world population (millions) in 2050'
        			},
        			scales: {
        				yAxes: [{
        					scaleLabel: {
        						display: true,
        						labelString: "Happiness"
        					}
        				}],
        				xAxes: [{
        					scaleLabel: {
        						display: true,
        						labelString: "GDP (PPP)"
        					}
        				}]
        			}
        		}
        	});
        });

    </script>
@endsection




















