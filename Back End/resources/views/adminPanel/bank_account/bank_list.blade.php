@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title">Bank List</div>

            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Add Bank
                        </button>
                        {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add Category</a>--}}
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr class="t-trcolor">
                            <th>SI</th>
                            <th>Bank Name</th>
                            <th>Account Type</th>
                            <th>Branch Name</th>
                            <th>Phone</th>
                            <th>Available Balance</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($bankList as $key=>$back)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$back->bank_name}}</td>
                                <td>{{$back->account_type}}</td>
                                <td>{{$back->branch_name}}</td>
                                <td>{{$back->phone}}</td>
                                <td>{{$back->available_balance}}</td>
                                @if($back->status==1)
                                    <td><span class="badge bg-success">Active</span></td>
                                @else
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                @endif
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">Setting</button>
                                        <ul class="dropdown-menu" style="">
                                            <li onclick="editCategoryData({{$back}})"><a class="dropdown-item" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    Edit</a>
                                            </li>
{{--                                            <li class="align-items-center" onclick="return confirm('Are you sure you want to delete this item?');"><a class="dropdown-item" href="{{}}">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-primary"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>--}}
{{--                                                    Delete</a>--}}
{{--                                            </li>--}}

                                        </ul>
                                    </div>
                                </td>
                            </tr>


                            @endforeach

                            </tr>


                        </tbody>
                        {{--                        <tfoot>--}}
                        {{--                        <tr>--}}
                        {{--                            <th>1</th>--}}
                        {{--                            <th>Position</th>--}}
                        {{--                            <th>Office</th>--}}
                        {{--                            <th>Age</th>--}}
                        {{--                            <th>Start date</th>--}}
                        {{--                        </tr>--}}
                        {{--                        </tfoot>--}}
                    </table>
                </div>
            </div>
        </div>
        {{--        modal--}}
        <!-- Modal -->
        <form action="{{route('admin.store.bank')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create New Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-1 row">
                                <div class="col-sm-6"> <label for="inputname" class="col-sm-12  pr-0 col-form-label">Bank Name <stong class="text-danger">*</stong></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="inputname" class="form-control" name="bank_name"  placeholder="Bank Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Account Type <stong class="text-danger">*</stong></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="account_type" class="form-control" name="account_type"  placeholder="Bank Name" required>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Account Number</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="account_number_data"  value="" class="form-control" name="account_number"  placeholder="Account Number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Phone</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="available_balance_data"  value="" class="form-control" name="phone"  placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Branch Name </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="inputname"  class="form-control" value="{{old('branch_name')}}" name="branch_name"  placeholder="Branch Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Available Balance</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="inputname"  value="" class="form-control" name="available_balance"  placeholder="Balance">
                                    </div>
                                </div>


                            </div>
                            <div class="mb-2 row">
                                <label for="description" class="col-sm-12  pr-0 col-form-label">Note</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="description" name="note" id="" cols="30" rows="3"></textarea>
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
        <form action="{{route('admin.update.bank')}}" method="post">
            @csrf
            <div class="modal fade" id="category_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <input type="hidden" value="" id="bank_id" name="bank_id" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-1 row">
                                <div class="col-sm-6"> <label for="inputname" class="col-sm-12  pr-0 col-form-label">Bank Name <stong class="text-danger">*</stong></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="bank_name" class="form-control" name="bank_name"  placeholder="Bank Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Account Type <stong class="text-danger">*</stong></label>
                                    <div class="col-sm-12">
                                        <input type="text" id="account_type_set" class="form-control" name="account_type"  placeholder="Bank Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Account Number</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="account_number"  value="" class="form-control" name="account_number"  placeholder="Account Number">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Phone</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="phone_data"  value="" class="form-control" name="phone"  placeholder="Phone">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Branch Name </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="branch_name"  class="form-control" value="{{old('branch_name')}}" name="branch_name"  placeholder="Branch Name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Available Balance</label>
                                    <div class="col-sm-12">
                                        <input type="number" id="available_balance"  value="" class="form-control" name="available_balance"  placeholder="Balance">
                                    </div>
                                </div>
                            </div>


                            <div class="mb-2 row">
                                <label for="description" class="col-sm-12  pr-0 col-form-label">Note</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="note" name="note" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
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
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>

        function editCategoryData(data){
            $('#bank_id').val(data.id)
            $('#bank_name').val(data.bank_name)
            $('#account_name').val(data.account_name)
            $('#phone_data').val(data.phone)
            $('#account_type_set').val(data.account_type)
            $('#branch_name').val(data.branch_name)
            $('#available_balance').val(data.available_balance)
            $('#note').val(data.note)
            $('#account_number').val(data.account_number)
            $('#category_edit').modal('show')

        }


        $(document).ready(function() {
            // $('#example').DataTable();
            $('#example').DataTable({
                "dom": 'rtip'
                // paging: false,
                // ordering: false,
                // info: false,
            });
        } );
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
