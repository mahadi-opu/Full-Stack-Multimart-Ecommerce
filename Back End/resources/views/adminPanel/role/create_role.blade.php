@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <div>
            <div class="d-flex justify-content-center">
                <div class="row col-sm-10">
                    <div class="card">
                        <form action="{{route('admin.role.store')}}" method="post">
                            @csrf
                        <div class="card-body">
                            <input type="hidden" value="emt077"  name="role_id[]">
                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <div class="row mb-4 d-flex justify-content-center">
                                        <div class="col-sm-4">
                                            <input type="text" name="role_name" class="form-control"  placeholder="Role Name" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-12 role_head">
                                    <h6><p>Admin Access <input class="form-check-input" type="checkbox" value="h1"  name="role_id[]" id="flexCheckDefault" checked></p> </h6>
                                    </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="1"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Create User Role
                                        </label>
                                    </div>
                                </div><div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="2"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Create Admin
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Sell Access <input class="form-check-input" type="checkbox" value="h2"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="3"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Product Sell
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="4"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Sell List
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Product Access <input class="form-check-input" type="checkbox" value="h3"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="5"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Create Product
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="6"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Create Product Category
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="7"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Create Product Subcategory
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="8"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            View Product List
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Product Stock <input class="form-check-input" type="checkbox" value="h4"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="9"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Purchase Product
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Offer Setting <input class="form-check-input" type="checkbox" value="h5"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="10"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Create Offer Banner
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="11"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Select Offer Product
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Setting <input class="form-check-input" type="checkbox" value="h6"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="12"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Company Info Set
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="13"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Shipping Currency Set
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Bank <input class="form-check-input" type="checkbox" value="h7"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="14"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Create Bank
                                        </label>
                                    </div>
                                </div>


                            </div>





                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Order Access <input class="form-check-input" type="checkbox" value="h8"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="15"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            pending
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="16"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Processing
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="17"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            On The Way
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="18"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Cancel Request
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="19"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Cancel Accept
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="20"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Cancel Completed
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="21"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                           Order  Completed
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 roldiv">
                                <div class="col-sm-12 role_head">
                                    <h6><p>Report <input class="form-check-input" type="checkbox" value="h9"  name="role_id[]" id="flexCheckDefault" checked></p></h6>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="22"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Product Sell Report
                                        </label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" value="23"  name="role_id[]" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Product Profit  Report
                                        </label>
                                    </div>
                                </div>


                            </div>

                            <div class="text-center">
                                <button  class="btn btn-info w-25 text-white" type="submit">Save</button>
                            </div>

                        </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>

    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );

            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
    </script>

@endsection
