@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">

        <div class="card">
            <div class="card-body">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="d-flex gap-3 mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    <i class="lni lni-circle-plus"></i> Add Subcategory
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr class="t-trcolor">
                            <th>SI</th>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($productSubcategory as $key=>$subcategoryList)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$subcategoryList->category->name}}</td>
                                <td>{{$subcategoryList->name}}</td>
                                <td>{{$subcategoryList->note}}</td>
                                @if($subcategoryList->status==1)
                                    <td><span class="badge bg-success">Active</span></td>
                                @else
                                    <td>
                                        <span class="badge bg-danger">Inactive</span>
                                    </td>
                                @endif
                                {{--                                <td>{{ date('d-M-y',strtotime($subcategoryList->created_at)) }}</td>--}}
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Settings
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                            <li onclick="editCategoryData({{$subcategoryList}})"><a class="dropdown-item" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                    Edit</a>
                                            </li>
                                            <li class="align-items-center" onclick="return confirm('Are you sure you want to delete this item?');"><a class="dropdown-item" href="{{route('admin.delete.subcategory',['id'=>$subcategoryList->id])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-primary"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                    Delete</a>
                                            </li>

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

        <!-- Modal -->
        <form action="{{route('admin.store.subcategory')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <label for="single-select-field" class="form-label">Product Category
                                    <stong class="text-danger">*</stong>
                                </label>
                                <select class="form-select" name="category_id" id="single-select-field"
                                        data-placeholder="Choose Category" required>
                                    <option value="">Choose Category</option>
                                    @foreach($productCategory as  $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mt-2 row">
                                <label for="inputPassword" class="col-sm-12  pr-0 col-form-label">Subcategory Name
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" id="inputPassword"
                                           placeholder="Subcategory Name" required>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="inputPasswordww" class="col-sm-12  pr-0 col-form-label">Subcategory
                                    Image</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="img" id="inputPasswordww"
                                           placeholder="Category Name">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="description" class="col-sm-12  pr-0 col-form-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="description" name="note" id="" cols="30"
                                              rows="3"></textarea>
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
        <form action="{{route('admin.update.subcategory')}}" method="post">
            @csrf
            <div class="modal fade" id="editsubcategory" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <input type="hidden" name="subcategory_id" id="subcategory_id">
                                <label for="single-select-field" class="form-label">Product Category
                                    <stong class="text-danger">*</stong>
                                </label>
                                <select class="form-select" name="category_id" id="ed_category_id"
                                        data-placeholder="Choose Category" required>
                                    <option value="">Choose Category</option>
                                    @foreach($productCategory as  $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mt-2 row">
                                <label for="inputPassword" class="col-sm-12  pr-0 col-form-label">Subcategory Name
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" id="ed_subcategory_name"
                                           placeholder="Subcategory Name" required>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="inputPasswordww" class="col-sm-12  pr-0 col-form-label">Subcategory
                                    Image</label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control" name="img" id="inputPasswordww"
                                           placeholder="Category Name">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="description" class="col-sm-12  pr-0 col-form-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="ed_description" name="note" id="" cols="30"
                                              rows="3"></textarea>
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


        {{--Modal--}}
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
            $('#example').DataTable();

        });
    </script>
    <script>
        function editCategoryData(data){

            $('#ed_category_id').val(data.category_id)
            $('#ed_subcategory_name').val(data.name)
            $('#ed_description').html(data.note)
            $('#subcategory_id').val(data.id)
            $('#editsubcategory').modal('show')

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
