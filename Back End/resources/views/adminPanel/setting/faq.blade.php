@extends('adminPanel.layout.layout')

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
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->
        <div class="card">
            <input type="hidden" id="selectimgdiv">
            <div class="card-body">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                    <div class="ms-auto">
                        <div class="btn-group">
                            <div class="d-flex gap-3 mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    <i class="lni lni-circle-plus"></i> Add Faq
                                </button>
                                {{--                        <a href="#" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add Category</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">

                        <thead>
                        <tr class="t-trcolor">
                            <th>SI</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($faqList as $key=>$faq)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$faq->title}}</td>
                                <td>{{$faq->details}}</td>

                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Action
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                            <li onclick="editCategoryData({{$faq}},'')"><a class="dropdown-item"
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
                                                <a class="dropdown-item"
                                                   href="{{route('faq.delete',['id'=>$faq->id])}}">
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
        <form action="{{route('faq.store')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create FAQ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2 row">
                                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Title
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" id="inputname" class="form-control" name="title"
                                           placeholder="Title" required>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="description" class="col-sm-12  pr-0 col-form-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="description" name="details" id="" cols="30"
                                              rows="3" placeholder="Description" required></textarea>
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

        <form action="{{route('faq.edit')}}" method="post">
            @csrf
            <div class="modal fade" id="category_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Faq</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2 row">
                                <input type="hidden" name="id" id="category_id">
                                <label for="inputname" class="col-sm-12  pr-0 col-form-label">title
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" id="ed_name" class="form-control" name="title"
                                           placeholder="Category Name" required>
                                </div>
                            </div>


                            <div class="mb-2 row">
                                <label for="ed_description" class="col-sm-12  pr-0 col-form-label">Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="ed_description" name="details" cols="30" rows="3"
                                              required></textarea>
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
    {{--    crop--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
    {{--    crop--}}
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    {{--crop--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    {{--crop--}}
@endsection
@section('js')
    <script>

        function editCategoryData(data, img) {
            $('#ed_name').val(data.title)
            $('#ed_description').html(data.details)
            $('#category_id').val(data.id)
            $('#category_edit').modal('show')
        }


        $(document).ready(function () {
            // $('#example').DataTable();
            $('#example').DataTable({
                "dom": 'rtip'
                // paging: false,
                // ordering: false,
                // info: false,
            });
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
                width: 500,
                height: 400,
            });

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    let inputvaluocation = $('#selectimgdiv').val() + 'input';
                    let viewlocation = $('#selectimgdiv').val() + 'view';
                    var uniqnumber = new Date().valueOf();

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

        function discountType(data) {

            if ($(data).val() == 0) {
                $('#discount').html(`<label for="inputStarPoints" class="form-label">Discount Amount</label><input type="number" name="discount" class="form-control" placeholder="Amount">`)
            }
            if ($(data).val() == 1) {
                $('#discount').html(`  <label for="inputStarPoints" class="form-label">Discount (%)</label>
                                            <input type="number" name="discount" class="form-control" placeholder="Percentage (%)" required>`)
            }
        }


        function readFile() {
            if (!this.files || !this.files[0]) return;
            const FR = new FileReader();
            FR.addEventListener("load", function (evt) {
                document.querySelector("#updateimg").src = evt.target.result;
                // document.querySelector("#inp2").val = evt.target.result;
                $('#inp2').val(evt.target.result);
            });
            FR.readAsDataURL(this.files[0]);
        }

        document.querySelector("#inp").addEventListener("change", readFile);

        function changeBrand() {
            $('#inp').click();
        }


    </script>

@endsection
