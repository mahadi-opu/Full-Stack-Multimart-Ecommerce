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
                                    <i class="lni lni-circle-plus"></i> Add Featured
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
                            <th>Link</th>
                            <th>Feature Image</th>
                            <th>Status</th>
                            <th>Create Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        @foreach($featuredImage as $key=>$feature)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$feature->title}}</td>
                                <td>{{$feature->link}}</td>
                                <td class="d-flex justify-content-center"><img src="{{ asset($feature->image)}}" height="60px" width="60px" alt=""></td>
                                                                @if($feature->is_active==1)
                                                                    <td><span class="badge bg-success">Active</span></td>
                                                                @else
                                                                    <td><span class="badge bg-danger">Inactive</span></td>
                                                                @endif
                                <td>{{ date('d-M-y',strtotime($feature->created_at)) }}</td>
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-primary dropdown-toggle dr-btn" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">Action
                                        </button>
                                        <ul class="dropdown-menu" style="">
                                            <li onclick="editCategoryData({{$feature}},'{{ asset($feature->image)}}')"><a
                                                    class="dropdown-item" href="#">
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
                                            {{--                                            <li class="align-items-center" onclick="return confirm('Are you sure you want to delete this item?');"><a class="dropdown-item" href="{{route('admin.delete.category',['id'=>$brand->id])}}">--}}
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
        <form action="{{route('admin.featured.store')}}" method="post">
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Featured</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2 row">
                                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Featured Title
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" id="inputname" class="form-control" name="title"
                                           placeholder="Featured Title">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <label for="inputname" class="col-sm-12  pr-0 col-form-label">Featured Link
                                    <stong class="text-danger">*</stong>
                                </label>
                                <div class="col-sm-12">
                                    <input type="text" id="inputname" class="form-control" name="featured_link"
                                           placeholder="Featured Link">
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Is Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <div class="col-sm-12 mt-2">
                                    <label for="inputProductDescription" class="form-label">Featured Image</label>
                                    <input style="display:none" type="file" name="image" class="image">
                                    <div class="row d-flex justify-content-center" id="productImglist">
                                        <div class="col-sm-4 mb-2" style="position:relative" id="222"
                                             onclick="selectImage('222')">
                                            <span class="text-center mainphototxt">Main Photo</span>
                                            <input type="hidden" name="banner_img" class="222input">
                                            <div
                                                class="imgaddcard d-flex justify-content-center align-items-center 222view ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-camera text-primary imgsvg">
                                                    <path
                                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                                    <circle cx="12" cy="13" r="4"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade modalimage" id="modal" tabindex="-1" role="dialog"
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
                                                                <img id="image" src="" alt="">
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
                                                    <button type="button" class="btn btn-primary" id="crop">Crop
                                                    </button>
                                                </div>
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
        <form action="{{route('admin.featured.update')}}" method="post">
            @csrf
            <div class="modal fade" id="category_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Featured</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-2 row">
                                <input type="hidden" name="id" id="category_id">
                                <div class="mb-2 row">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Featured Title
                                        <stong class="text-danger">*</stong>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="fetitle" class="form-control" name="title"
                                               placeholder="Featured Title">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label for="inputname" class="col-sm-12  pr-0 col-form-label">Featured Link
                                        <stong class="text-danger">*</stong>
                                    </label>
                                    <div class="col-sm-12">
                                        <input type="text" id="felink" class="form-control" name="featured_link"
                                               placeholder="Featured Link">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <div class="col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="activecheck" checked>
                                            <label class="form-check-label" for="defaultCheck1">
                                                Is Active
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            <div class="mb-2 mt-2 row d-flex justify-content-center" style="position: relative">

                                <div class="d-flex justify-content-center">
                                     <span onclick="changeBrand()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </span>
                                    <img id="updateimg" style=" height: 140px;width: 140px;border: 1px solid #e5e2e2;border-radius: 20px;padding: 0px;" src="" alt="">
                                </div>


                            </div>


                            <div class="row d-flex justify-content-center" id="productImglist">
                                <input style="display: none" id="inp"  type="file">
                                <input style="display: none" id="inp2" name="updateImage" type="text">
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

            $('#fetitle').val(data.title)
            $('#felink').val(data.link)
            // if(data.is_active==1){
            //     alert(data.is_active)
            //     $("#is_active").prop('checked')
            // }

            if(data.is_active==0){
                $('#activecheck').prop('unchecked');
            }

            $('#category_id').val(data.id)
            $('#category_edit').modal('show')
            $('#updateimg').attr("src", img);
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
            $('.updateimg').attributes()


        }

        function readFile() {
            if (!this.files || !this.files[0]) return;
            const FR = new FileReader();
            FR.addEventListener("load", function(evt) {
                document.querySelector("#updateimg").src= evt.target.result;
                // document.querySelector("#inp2").val = evt.target.result;
                $('#inp2').val(evt.target.result);
            });
            FR.readAsDataURL(this.files[0]);
        }

        document.querySelector("#inp").addEventListener("change", readFile);

        function  changeBrand(){
            $('#inp').click();
        }

    </script>

@endsection
