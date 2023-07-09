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
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title"></div>
            <input type="hidden" id="selectimgdiv">
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="d-flex gap-3 mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            <i class="lni lni-circle-plus"></i> Add Offer
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
                            <th>Banner</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($offer as $key=>$offerList)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    {{$offerList->offer_name}}
                                </td>
                                <td><img height="60px" src="{{asset($offerList->banner_image)}}" alt=""></td>
                                <td>
                                    {{$offerList->start_date}}
                                </td>
                                <td> {{$offerList->end_date}}</td>
                                @if($offerList->status==1)
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
                                            <li onclick="editSupplierInfo({{$offerList}},'{{asset($offerList->banner_image)}}')">
                                                <a
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
                                            <li>

                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.offer.product.list',['id'=>$offerList->id])}}">
                                                    <i class="lni lni-offer"
                                                       style="    color: #008cff!important;font-size: 21px;"></i>Offer
                                                    Products</a>
                                            </li>
                                            <li class="align-items-center"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <a
                                                    class="dropdown-item"
                                                    href="{{route('admin.delete.offer.banner',['id'=>$offerList->id])}}">
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
        <form action="{{route('admin.store.offer')}}" method="post">
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
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Offer Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputname" class="form-control"
                                                       name="offer_name"
                                                       placeholder="Offer Name" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Start Date
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="date" id="inputname" class="form-control"
                                                       name="start_date"
                                                       placeholder="Start Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">End Date
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="date" id="inputname" class="form-control"
                                                       name="end_date"
                                                       placeholder="End Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-2">
                                            <label for="inputProductDescription" class="form-label">Banner Photo</label>
                                            <input style="display:none" type="file" name="image" class="image">
                                            <div class="row" id="productImglist">
                                                <div class="col-sm-12 mb-2" style="position:relative" id="222"
                                                     onclick="selectImage('222')">
                                                    <span class="text-center mainphototxt">Main Photo</span>
                                                    <input type="hidden" name="banner_img" class="222input">
                                                    <div
                                                        class="imgaddcard d-flex justify-content-center align-items-center 222view ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70"
                                                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                             stroke-width="2" stroke-linecap="round"
                                                             stroke-linejoin="round"
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
                                                            <button type="button" class="btn btn-primary" id="crop">Crop
                                                            </button>
                                                        </div>
                                                    </div>
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
        <form action="{{route('admin.update.offer')}}" method="post">
            @csrf
            <div class="modal fade" id="supplier_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="offer_id" id="offer_id">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Offer Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="offer_name" class="form-control"
                                                       name="offer_name"
                                                       placeholder="Offer Name" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Start Date
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="date" id="startdate" class="form-control"
                                                       name="start_date"
                                                       placeholder="Start Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-2">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">End Date
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="date" id="enddate" class="form-control"
                                                       name="end_date"
                                                       placeholder="End Date" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mt-2">
                                            <div class="mb-2 mt-2 row d-flex justify-content-center"
                                                 style="position: relative">

                                                <div class="d-flex justify-content-center">
                                     <span onclick="changeBrand()">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-edit text-primary"><path
                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                     </span>
                                                    <img id="updateimg" style="height: 160px;width: 340px;border: 1px solid #e5e2e2;border-radius: 20px;padding: 0px;" src="" alt="">
                                                </div>


                                            </div>


                                            <div class="row d-flex justify-content-center" id="productImglist">
                                                <input style="display: none" id="inp" type="file">
                                                <input style="display: none" id="inp2" name="updateImage" type="text">
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
    {{--    select2--}}
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}

    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    {{--    crop--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
    {{--    crop--}}
@endsection
@section('js_plugins')

    {{--select 2--}}
    <script
        src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    {{--select 2--}}

    {{--    crop--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    {{--    crop--}}


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
        function editSupplierInfo(offerList, image) {
            // console.log(offerList);
            // alert(offerList.offer_name)
            // offerList.offer_name

            $('#offer_id').val(offerList.id)
            $('#offer_name').val(offerList.offer_name)
            $('#startdate').val(offerList.start_date)
            $('#enddate').val(offerList.end_date)
            console.log(image)
            $('#updateimg').attr("src", image);

            $('#supplier_edit').modal('show')


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
                aspectRatio: 2,
                viewMode: 3,
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
                    // $('#productImglist').append(`
                    //   <div class="col-sm-3 mb-2" style="position:relative" id="${uniqnumber}" >
                    //    <div class="remocespen" onclick="removeImage(${uniqnumber})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle imgsvg removebtn"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></div>
                    //    <div onclick="selectImage(${uniqnumber})">
                    //    <input type="hidden" name="product_img[]" class="${uniqnumber}input">
                    //        <div class="imgaddcard d-flex justify-content-center align-items-center ${uniqnumber}view " >
                    //            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#171e243d" class="feather feather-camera imgsvg"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    //        </div>
                    //     </div>
                    //     </div>
                    // `)
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
