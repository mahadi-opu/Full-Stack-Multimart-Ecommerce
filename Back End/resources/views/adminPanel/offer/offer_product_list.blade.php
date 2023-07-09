@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title">
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Add Offer Product
                        </button>
                        {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add Category</a>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Offer Name</th>
                            <th>Product Name</th>
                            <th>Offer Type</th>
                            <th>Offer Discount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($offerProductList as $key=>$offerListdata)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$offerListdata->offerInfo->offer_name}}
                                </td>
                                <td>
                                    {{$offerListdata->productInfo->name}}
                                </td>
                                @if($offerListdata->offer_type==0)
                                    <td><span class="badge bg-success">Fixed</span></td>
                                @else
                                    <td>
                                        <span class="badge bg-info">Percentage</span>
                                    </td>
                                @endif

                                @if($offerListdata->offer_type==0)
                                    <td><span >{{$offerListdata->offer_amount}}</span></td>
                                @else
                                    <td>
                                        <span >{{$offerListdata->offer_amount}} (%)</span>
                                    </td>
                                @endif
                                    <td><span>{{$offerListdata->offerInfo->start_date}}</span></td>

                                    <td>
                                        <span >{{$offerListdata->offerInfo->end_date}}</span>
                                    </td>

                                @if($offerListdata->offerInfo->status==1)
                                    <td><span class="badge bg-success">Active</span></td>
                                @else
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                @endif

                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Settings
                                        </button>
                                        <ul class="dropdown-menu" style="">
{{--                                            <li onclick="editSupplierInfo({{$offerListdata->id}})"><a--}}
{{--                                                    class="dropdown-item"--}}
{{--                                                    href="#">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"--}}
{{--                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"--}}
{{--                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                         class="feather feather-edit text-primary">--}}
{{--                                                        <path--}}
{{--                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>--}}
{{--                                                        <path--}}
{{--                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>--}}
{{--                                                    </svg>--}}
{{--                                                    Edit</a>--}}
{{--                                            </li>--}}
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.product.offerProduct.delete',['id'=>$offerListdata->id])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-trash text-primary">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    </svg>
                                                    Delete</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                        <tfoot>
                        {{--                        <tr>--}}
                        {{--                            <th colspan="6"></th>--}}
                        {{--                            <th>Salary</th>--}}
                        {{--                        </tr>--}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        {{--        modal--}}
        <!-- Modal -->
        <form action="{{route('admin.offer.product.store')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Offer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Offer
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <select name="offer_id" id="" class="form-select" placeholder="choose offer" required>
                                                    @foreach($offerList as $offer)
                                                        <option value="{{$offer->id}}">{{$offer->offer_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Select Product
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <select class="form-select" name="offer_product_list[]" id="multiple-select-field" data-placeholder="Choose Products" multiple required>
                                                @foreach($productList as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Offer Type
                                            </label>
                                            <div class="col-sm-12">
                                                <select class="form-select" onchange="offerTypeSet(this)" name="offer_type" required>
                                                        <option value="0">Fixed</option>
                                                        <option value="1">Percentage (%) </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Amount
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="number" id="offerAmount" class="form-control"
                                                       name="amount"
                                                       placeholder="Offer Amount" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        {{--Edit --}}
        <form action="{{route('admin.update.supplier')}}" method="post">
            @csrf
            <div class="modal fade" id="supplier_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="updateinfo">

                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{--        modal--}}
    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    {{--    select2--}}
    <link rel="stylesheet" href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    {{--select 2--}}
    <script src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    {{--select 2--}}
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
    <script>
        function editSupplierInfo(id) {
            var url_link = "{{route('supplier.edit.info')}}"
            $.ajax({
                url: url_link,
                type: "get",
                data: {
                    id: id,
                },
                success: function (response) {
                    $('#updateinfo').html(response)
                    $('#supplier_edit').modal('show')
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });


        }

        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });

        $('.discountType').on('change', function () {
            var selectval = $(this).val();
            if (selectval == 0) {
                $('#discountAmount').attr('placeholder', 'Total Discount');
            }
            if (selectval == 1) {
                $('#discountAmount').attr('placeholder', 'Discount (%)');
            }
        })

        function offerTypeSet(data){
            $data=$(data).val();
            if($data==0){
                $('#offerAmount').attr('placeholder','Fixed Amount');
                }
            if($data==1){
                $('#offerAmount').attr('placeholder','percentage (%)');
            }
        }

    </script>

@endsection
