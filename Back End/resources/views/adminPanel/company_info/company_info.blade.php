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
        <input type="hidden" id="selectimgdiv">
        <form method="post" action="{{route('company.info.store')}}">
            @csrf
        <div class="row d-flex justify-content-center">

            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="headst__set">
                            <h4>Company Info</h4>
                        </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Name
                                                </label>
                                                <input type="text" name="name"
                                                       value="{{$companyInfo->name}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Phone
                                                </label>
                                                <input type="text" name="phone"
                                                       value="{{$companyInfo->phone}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Email
                                                </label>
                                                <input type="text" name="email"
                                                       value="{{$companyInfo->email}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">FaceBook Link
                                                </label>
                                                <input type="text" name="facebook_link"
                                                       value="{{$companyInfo->facebook_link}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">YouTube Link
                                                </label>
                                                <input type="text" name="youtube_link"
                                                       value="{{$companyInfo->youtube_link}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Twitter
                                                </label>
                                                <input type="text" name="twitter_link"
                                                       value="{{$companyInfo->twitter_link}}" class="form-control"
                                                       id="exampleInputPassword1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12 mt-2">
                                            <input style="display:none" type="file" name="image" class="image">
                                            <div class="row d-flex " id="productImglist">
                                                <div class="imgmaindiv imgmaindiv" style="position:relative" id="222"
                                                     onclick="selectImage('222')">
                                                    <span
                                                        class=" d-flex  justify-content-center text-center mainphototxtlogo text-info">Logo</span>
                                                    <input type="hidden" name="company_logo"
                                                           value="{{$companyInfo->company_logo}}" class="222input">
                                                    <div
                                                        class="imgaddcardinfopg d-flex justify-content-center align-items-center 222view ">
                                                        @if($companyInfo->company_logo)
                                                            <img class="imgaddborder"
                                                                 src="{{asset($companyInfo->company_logo)}}" alt=""
                                                                 width="100%" height="100%">
                                                        @else
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70"
                                                                 height="70"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2" stroke-linecap="round"
                                                                 stroke-linejoin="round"
                                                                 class="feather feather-camera text-primary imgsvg">
                                                                <path
                                                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                                                <circle cx="12" cy="13" r="4"></circle>
                                                            </svg>

                                                        @endif
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
                            <div class="row">


                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Address
                                        </label>
                                        <textarea class="form-control" name="company_address" id="" cols="30" rows="3">{{$companyInfo->company_address}}</textarea>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">About Us
                                        </label>
                                        <textarea class="form-control" name="about_us" id="" cols="30" rows="3">{{$companyInfo->about_us}}</textarea>

                                    </div>
                                </div>

                            </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="headst__set">
                            <h4>Policy</h4>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">
                                            Privacy Policy
                                        </label>
                                        <textarea class="form-control" name="privacy_policy" id="" cols="30" rows="3">{{$companyInfo->privacy_policy}}</textarea>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">
                                            Refund Policy
                                        </label>
                                        <textarea class="form-control" name="refund_policy" id="" cols="30" rows="3">{{$companyInfo->refund_policy}}</textarea>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">
                                            Shipping Policy
                                        </label>
                                        <textarea class="form-control" name="shipping_policy" id="" cols="30" rows="3">{{$companyInfo->shipping_policy}}</textarea>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">
                                            Terms & Condition
                                        </label>
                                        <textarea class="form-control" name="terms_condition" id="" cols="30" rows="3">{{$companyInfo->terms_condition}}</textarea>

                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save</button>


                    </div>
                </div>
            </div>

        </div>
        </form>


    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
@endsection
@section('js')
    @section('js')
        <script>

            function editCategoryData(data) {
                $('#ed_name').val(data.name)
                $('#ed_description').html(data.note)
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


        </script>

    @endsection

@endsection
