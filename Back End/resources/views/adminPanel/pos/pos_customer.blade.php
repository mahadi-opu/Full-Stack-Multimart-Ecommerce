@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title">POS Customer List</div>

            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Add Customer
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($posCustomer as $key=>$posCustomerList)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$posCustomerList->name}}
                                </td>
                                <td>
                                    {{$posCustomerList->phone}}
                                </td>
                                <td>{{$posCustomerList->email}}</td>
                                <td>{{$posCustomerList->address}}</td>
                                @if($posCustomerList->status==1)
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
                                            <li onclick="editCustomerInfo({{$posCustomerList}})"><a
                                                    class="dropdown-item"
                                                    href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-edit text-primary">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                    Edit</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="#">
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
        <form action="{{route('admin.store.pos.customer')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="name"
                                                       placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Phone
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="phone"
                                                       placeholder="Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Email
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="email"
                                                       placeholder="email">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="supplier_address" class="col-sm-12  pr-0 col-form-label">
                                                Address
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="supplier_address" class="form-control"
                                                          id="supplier_address" cols="10" rows="3"
                                                          placeholder="Address"></textarea>
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
        <form action="{{route('admin.pos.customer.update')}}" method="post">
            @csrf
            <div class="modal fade" id="customer_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-4">
                                            <input type="hidden" name="id" id="customerid">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="name" class="form-control"
                                                       name="name"
                                                       placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Phone
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="phone" class="form-control"
                                                       name="phone"
                                                       placeholder="Phone">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Email
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="email" id="email" class="form-control"
                                                       name="email"
                                                       placeholder="email">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="supplier_address" class="col-sm-12  pr-0 col-form-label">
                                                Address
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="address" class="form-control"
                                                          id="address" cols="10" rows="3"
                                                          placeholder="Address"></textarea>
                                            </div>
                                        </div>

                                    </div>
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
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>
    <script>
        function editCustomerInfo(data) {
            $('#customerid').val(data.id);
            $('#name').val(data.name);
            $('#phone').val(data.phone);
            $('#email').val(data.email);
            $('#address').val(data.address);
            $('#customer_edit').modal('show');
        }

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
