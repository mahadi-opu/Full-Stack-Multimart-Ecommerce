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
                    <form action="">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="d-flex justify-content-center align-items-center col-sm-4">
                                <input type="date" name="startdate" value="{{request()->startdate}}" class="form-control">
                                &nbsp;
                                To
                                &nbsp;
                                <input type="date" name="enddate" value="{{request()->enddate}}"  class="form-control"> &nbsp;
                                <button type="submit" class="btn btn-info ml-3" style="height: 34px; color: white;">search</button>
                            </div>
                        </div>
                    </form>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sell Quantity</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellProduct as $key=>$sellInfo)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>#{{$sellInfo->code}}</td>
                            <td>{{$sellInfo->name}}</td>
                            <td>{{$sellInfo->total_sell}}</td>

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
