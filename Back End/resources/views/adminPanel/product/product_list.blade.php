@extends('adminPanel.layout.layout')
@section('css')
    <style>
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>
@endsection
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->

        <div class="card">
            <div class="card-body">
                <input type="hidden" id="selectimgdiv">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Name</th>
                            <th>Code</th>
                            {{--<th>Category</th>--}}
                            {{--<th>Subcategory</th>--}}
                            <th>Photo</th>
                            <th>Sell Price</th>
                            <th>WholeSell Price</th>
                            <th>Available</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productList as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>

                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->code}}
                                </td>
                                {{--<td>--}}
                                {{--{{$product->productCategory->name}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                {{--{{$product->productSubcategory->name}}--}}
                                {{--</td>--}}
                                <td>
                                    <img class="productImglistst" src="{{asset($product->image_path)}}" alt="">
                                </td>
                                <td>{{$product->current_sale_price}}</td>
                                <td>{{$product->current_wholesale_price}}</td>
                                <td>{{$product->available_quantity}}</td>
                                @if($product->status==1)
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
                                            <li onclick="editCustomerInfo({{$product}})"><a
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
                                                    View</a>
                                            </li>
                                            <li onclick="barcodePrint( {{$product->id}})" style="cursor: pointer">
                                                <span
                                                    class="dropdown-item"
                                                    href="">
                                                    <i class="lni lni-printer" style="    font-size: 18px;color: #008cff;"></i>
                                                    Barcode Print
                                                </span>
                                            </li>
                                            <li onclick="editProductInfo({{$product->id}})"><a
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
        <form action="{{route('admin.edit.product')}}" method="post">
            @csrf
            <div class="modal fade" id="customer_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="editProduct">

                        </div>
                        {{--                        <div class="d-flex justify-content-end p-3">--}}
                        {{--                            <button type="submit" class="btn btn-primary">Update</button>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </form>

        {{--        modal--}}

        {{--img crop--}}
        <div class="modal fade modalimage" id="modal" tabindex="-1"
             role="dialog"
             aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop image</h5>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">�</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Cancel
                        </button>
                        <button type="button" class="btn btn-primary" id="crop">
                            Crop
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{--img crop--}}

{{--Barcode Modal--}}
        <div class="modal" tabindex="-1" role="dialog" id="barcode">
            <div class="modal-dialog" role="document">
                <form action="{{route('product.barcode.generate')}}" method="get">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Barcode Generate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="product_id" id="product_id" required >
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Barcode Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" name="barcode_qty" class="form-control" id="inputEmail3" placeholder="Barcode Quantity">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Print</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
{{--Barcode Modal--}}
    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    {{--    crop--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
    {{--    crop--}}

    {{--    select2--}}
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}
@endsection
@section('js_plugins')
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/input-tags/js/tagsinput.js"></script>
    {{--    crop--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    {{--    crop--}}

    {{--select 2--}}
    <script src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/input-tags/js/tagsinput.js"></script>
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
        $('#myInput').tagsinput();
        function editProductInfo(product_id) {
            var url_link = "{{route('product.edit.info')}}"
            $.ajax({
                url: url_link,
                type: "get",
                data: {
                    product_id: product_id,
                },
                success: function (response) {
                    $('#editProduct').html(response);
                    $('#myInput').tagsinput('refresh');
                    $('.js-example-basic-multiple').select2();
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });

            $('#customer_edit').modal('show');
            // $("#taglist").tagsinput('items')

            $('#myInput').tagsinput();





        }

        // function tagreset(){
        //     $('#myInput').tagsinput('refresh');
        // }

        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>

        var bs_modal = $('#modal');
        var image = document.getElementById('image');
        var cropper, reader, file;


        $("body").on("change", ".image", function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;

                bs_modal.modal('show');
            };

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        bs_modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 0,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function () {
            canvas = cropper.getCroppedCanvas({
                width: 0,
                height: 0,
            });

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    let inputvaluocation = $('#selectimgdiv').val() + 'input';
                    let viewlocation = $('#selectimgdiv').val() + 'view';

                    $('.' + inputvaluocation).val(base64data)
                    $('.' + viewlocation).html(`  <img class="imgaddborder" src="${base64data}" height="100%" width="100%" alt="">`);

                    $(".modalimage").modal('hide');


                };
            });
        });


        function selectImage(data) {
            $('#selectimgdiv').val(data);
            $('.image').click();
        }

        function removeImage(id) {
            $('#' + id).html(`<div class="remocespen" onclick="removeImage(${id})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle imgsvg removebtn"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div>
                       <div onclick="selectImage(${id})">
                       <input type="hidden" name="product_img[]" class="${id}input">
                           <div class="imgaddcard d-flex justify-content-center align-items-center ${id}view " >
                               <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                           </div>
                        </div>`);
        }

        function deleteItem(id) {
            var url = "{{route('product.image.delete')}}";
            $.ajax({
                url: url,
                type: "get",
                data: {
                    id: id,
                },
                success: function (response) {
                    if (response == 'success') {
                        $('#' + id).remove()
                    }
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });
        }

        function addNewImage() {
            var uniqnumber = new Date().valueOf();
            $('#productImglist').append(`
                      <div class="col-sm-3 mb-2" style="position:relative" id="${uniqnumber}" >
                       <span class="imgeditbtn" onclick="deletenewItem(${uniqnumber})" " ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash text-primary"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span> &nbsp;
                       <div onclick="selectImage(${uniqnumber})">
                       <input type="hidden" name="new_product_img[]" class="${uniqnumber}input">
                           <div class="imgaddcard d-flex justify-content-center align-items-center ${uniqnumber}view " >
                               <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                           </div>
                        </div>
                        </div>
                    `)
        }

        function discountType(data) {
            if ($(data).val() == 0) {
                $('#discount').html(`<label for="inputStarPoints" class="form-label">Discount Amount</label><input type="number" name="discount" class="form-control" placeholder="Amount">`)
            }
            if ($(data).val() == 1) {
                $('#discount').html(`  <label for="inputStarPoints" class="form-label">Discount (%)</label>
                                            <input type="number" name="discount" class="form-control" placeholder="Percentage (%)" required>`)
            }
        }

        function deletenewItem(id) {
            $('#' + id).remove()
        }

         function barcodePrint(product_id){

            $('#product_id').val(product_id)
            $('#barcode').modal('show');

        }

        function    addnewcolor(){
            // alert('sdfs')
            const color=`<span><input type="color" name="product_color[]" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color"></span>`;
            $('#color').append(color)
        }




    </script>

@endsection
