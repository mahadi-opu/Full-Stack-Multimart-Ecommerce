@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="card  w-100 itemcard" onclick="selecteditem(this)" style="position: relative">
                                <input class="form-check-input selectinputfr"  type="checkbox" value="" id="flexCheckDefault">
                            <img  style="object-fit: contain" src="http://127.0.0.1:8000/storage/product_images/product_images-16794636707938.png" class="card-img-top cardimageset" alt="...">
                            <div class="card-body text-white stmxhide">
                              <span class="pnamest">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying</span>
                                <br>
                            </div>
                            <span class="pricetx">Price: 34579</span>
                        </div>
                    </div>

                </div>



            </div>
        </div>

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

        $('.discountType').on('change',function(){
            var selectval=$(this).val();
            if(selectval==0){
                $('#discountAmount').attr('placeholder','Total Discount');
            }
            if(selectval==1){
                $('#discountAmount').attr('placeholder','Discount (%)');
            }
        })
       function selecteditem(data){

           if ($(data).find('.selectinputfr').prop("checked") == true) {
               $(data).find('.selectinputfr').prop( "checked", false );
           } else {
               $(data).find('.selectinputfr').prop( "checked", true );
           }




        }
    </script>

@endsection
