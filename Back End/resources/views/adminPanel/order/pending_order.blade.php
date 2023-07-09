@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
{{--        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">--}}
{{--            <div class="breadcrumb-title">POS Customer List</div>--}}

{{--            <div class="ms-auto">--}}
{{--                <div class="btn-group">--}}
{{--                    <div class="d-flex gap-3 mt-3">--}}
{{--                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"--}}
{{--                                data-bs-target="#exampleModal">--}}
{{--                            <i class="lni lni-circle-plus"></i> Add Customer--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Invoice No</th>
                            <th>Phone</th>
                            <th>Total Payable</th>
                            <th>Total Payed</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderList as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                  # {{$order->invoice_id}}
                                </td>
                                <td>017</td>
                                <td>
                                    {{ round($order->total_payable_amount) }}
                                </td>
                                <td>{{round($order->total_paid) }}</td>
                                @if($order->order_status==0)
                                    <td><span class="badge bg-success">Pending</span></td>
                                @elseif($order->order_status==1)
                                    <td>
                                        <span class="badge bg-danger">Processing</span>
                                    </td>
                                @elseif($order->order_status==2)
                                    <td>
                                        <span class="badge bg-danger">On The Way</span>
                                    </td>
                                @elseif($order->order_status==3)
                                <td>
                                    <span class="badge bg-danger">Cancel Request</span>
                                </td>
                                @elseif($order->order_status==4)
                                <td>
                                    <span class="badge bg-danger">Cancel Request accepted</span>
                                </td>
                                @elseif($order->order_status==5)
                                <td>
                                    <span class="badge bg-danger">Cancel Process Completed</span>
                                </td>
                                @elseif($order->order_status==6)
                                <td>
                                    <span class="badge bg-danger">Order Completed</span>
                                </td>
                                @endif

                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Settings
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                            <li><a
                                                    class="dropdown-item"
                                                    onclick="productDetails({{$order->id}})"
                                                    href="#">

                                                    Order Details</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to update this order status?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.order.status.update',['status'=>0,'order_id'=>$order->id])}}">
                                                    Pending</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to update this order status?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.order.status.update',['status'=>1,'order_id'=>$order->id])}}">
                                                    Processing</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to update this order status?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.order.status.update',['status'=>2,'order_id'=>$order->id])}}">
                                                    On The Way</a>
                                            </li>
                                            @if($order->order_status==3)
                                                <li class="align-items-center"
                                                    onclick="return confirm('Are you sure you want to update this order status?');">
                                                    <a
                                                        class="dropdown-item"
                                                        href="{{route('admin.order.status.update',['status'=>4,'order_id'=>$order->id])}}">
                                                        Cancel Request Accepted</a>
                                                </li>
                                            @endif

{{--                                            <li class="align-items-center"--}}
{{--                                                onclick="return confirm('Are you sure you want to update this order status?');">--}}
{{--                                                <a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="{{route('admin.order.status.update',['status'=>4,'order_id'=>$order->id])}}">--}}
{{--                                                    Cancel Accepted</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="align-items-center"--}}
{{--                                                onclick="return confirm('Are you sure you want to update this order status?');">--}}
{{--                                                <a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="{{route('admin.order.status.update',['status'=>5,'order_id'=>$order->id])}}">--}}
{{--                                                    Cancel Process Completed </a>--}}
{{--                                            </li>--}}

                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to update this order status?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.order.status.update',['status'=>6,'order_id'=>$order->id])}}">
                                                    Order Completed</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach



                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="orderDetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body " id="detailInfo">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->



        {{--Edit --}}

        {{--        modal--}}
    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>
        function productDetails(order_id){
            // alert(data)
            const  router="{{url('admin/sell/order/details')}}"

            $.ajax({
                url: router,
                type: "get",
                data: {
                    "id": order_id,
                },
                success: function(response) {
                    console.log(response)
                    $('#detailInfo').html(response);
                },
                error: function(xhr) {
                    //Do Something to handle error
                }});



            $('#orderDetails').modal('show')
        }
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

@endsection
