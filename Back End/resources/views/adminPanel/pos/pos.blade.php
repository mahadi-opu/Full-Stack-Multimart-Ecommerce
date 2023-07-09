@extends('adminPanel.layout.layout')
@section('main_content')
    <div class="page-content">
        <input type="hidden" id="pageNo" value="0">
        <input type="hidden" id="submittype" value="1">
        <div class="row">
            <div class="col-sm-6" style="padding: 0px;">
                <div class="leftpos">
                    <input type="text" class="form-control" oninput="searchProduct(this)" placeholder="Search Product">

                    <div class="row productListDiv" id="productList">

                    </div>

                </div>

            </div>
            <div class="col-sm-6 mt-2" style="padding: 0px;">
                <form action="{{route('pos.payment.store')}}" method="post"  id="paymentshow">
                    @csrf
                <div class="rightpos">
                    <div class="row d-flex justify-content-center align-items-center posTopbar">
                        <div class="col-sm-8">
                            <input type="hidden" name="bank_id" id="set_bank_id">
                            <select name="customer_id" id="customerlist" class="form-control select2">
                                @foreach($posCustomerList as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-4 d-flex justify-content-end">
                            <span class="addCustomer" onclick="customeradd()"><i style="font-size: 18px;"
                                                                                 class="lni lni-circle-plus"></i> &nbsp; Customer</span>
                        </div>
                    </div>


                    <div id="orderList">

                    </div>
                    <input type="hidden" name="total_payable" id="total_payable"  class="duepayinput form-control">
                    <input type="hidden" name="total_paid" id="totalpayment"  class="duepayinput form-control">
                    <div>
                        <div class="posfooter_st">
                            <div class="details_bs">
                            </div>
                            <div class="discount_bs totaltx">
                                <span>Subtotal Total</span>
                            </div>
                            <div class="total_bs_ft" style="text-align: right">
                                <strong id="totalAmount">00</strong>
                            </div>
{{--                            <div class="crs_bs" onclick="removeItem(this)">--}}
{{--                            </div>--}}

                        </div>
                        <div class="posfooter_st">
                            <div class="details_bs">
                                <div style="display: flex;padding: 0px 10px" class="discountinput">
                                    <select name="discount_type" class="form-select" id="distypeset"
                                            onchange="countTotal()">
                                        <option value="0">Fixed</option>
                                        <option value="1">Percentage (%)</option>
                                    </select> &nbsp;
                                    <input type="number" name="total_discount" value="" id="discountamountset" oninput="countTotal()"
                                           class="form-control" placeholder="Discount">
                                </div>

                            </div>
                            <div class="discount_bs totaltx">
                                <span>Discount</span>
                            </div>
                            <div class="total_bs_ft" style="text-align: right">
                                <strong id="totaDiscount" class="total_discount_txt">00</strong>
                            </div>
{{--                            <div class="crs_bs">--}}
{{--                            </div>--}}

                        </div>
                        <div class="posfooter_st payablerowsty">
                            <div class="details_bs">
                            </div>
                            <div class="discount_bs totaltx">
                                <span>Payable Amount</span>
                            </div>
                            <div class="total_bs_ft" style="text-align: right">
                                <strong id="totaPayable" class="total_discount_txt">00</strong>
                            </div>
{{--                            <div class="crs_bs">--}}
{{--                            </div>--}}

                        </div>

                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-sm-3 d-flex justify-content-center">
                                <button type="submit" onclick="submittype(1)" class="addCustomer">Payment </button>
                            </div>

                        </div>

                    </div>

                </div>
                </form>
            </div>
        </div>


        {{--        customer create--}}

        <div class="modal fade" id="customeradd" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="" id="customeaddSubmit">
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
                                                <input type="text" id="inputphone" class="form-control"
                                                       name="phone"
                                                       placeholder="Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Email
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="inputemail" class="form-control"
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
            </form>
        </div>

        {{--        customer create--}}

        {{-- payment--}}
        <div class="modal fade" id="paymentadd" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="" id="store_pos_payment">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content modalpay">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-6"><span>Bank Account</span></div>
                                        <div class="col-6 payitem">
                                            <select  id="bank_id"  class="form-select">
                                                @foreach($bankList as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-6"><span>Total Payable Amount</span></div>
                                        <div class="col-6 payitem"><span id="payableamoutdata">00</span></div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="col-6"><span>Paid Amount</span></div>
                                        <div class="col-6 payitem">
                                            <input type="text" name="" id="totalmaymentamount" oninput="calculatedue(this)" class="duepayinput form-control">
{{--                                            <input type="hidden" name="total_payable" id="total_payable" oninput="calculatedue(this)" class="duepayinput form-control">--}}
                                        </div>
                                    </div>
                                    <div class="mb-2 row duerow">
                                        <div class="col-6"><span>Due Amount</span></div>
                                        <div class="col-6 payitem"><span id="totaldueamount">00</span></div>
                                    </div>
                                </div>
                                <div id="productItemList" style="display: none">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button type="submit" onclick="submittype(2)" class="btn btn-primary">Pay Now</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        {{-- payment--}}


    </div>

@endsection
@section('css_plugins')
    {{--    select2--}}
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    {{--    select2--}}
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')
    <script
        src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    {{--select 2--}}
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>

        $('#productList').on('scroll', function () {
            if ($('#productList').scrollTop() + $('#productList').innerHeight() >= $('#productList')[0].scrollHeight) {
                productList();
            }
        });
        productList();

        function productList() {
            var pageNo = +$('#pageNo').val();
            var currentPg = pageNo + 1;
            $('#pageNo').val(currentPg);
            $.ajax({
                url: "{{route('admin.pos.product.get')}}",
                type: "get",
                data: {
                    page: currentPg,
                },
                success: function (response) {
                    $('#productList').append(response)
                },
                error: function (xhr) {
                }
            });
        }


            function productInfo(product_id) {
                var isstay = 0;
                var selectItem = 0;
                $('.item_product_id').each(function () {
                    if (product_id == $(this).val()) {
                        isstay = 1;
                        selectItem = this;
                    }
                })
                if (isstay) {
                    let qty = +$(selectItem).parent().find('.sellqty').val();
                    $(selectItem).parent().find('.sellqty').val(qty + 1);
                    countTotal();

                } else {
                    $.ajax({
                        url: "{{route('admin.pos.sell.item.get')}}",
                        type: "get",
                        data: {
                            product_id: product_id,
                        },
                        success: function (response) {

                            $('#orderList').append(response)
                            countTotal();
                        },
                        error: function (xhr) {
                        }
                    });
                }
            }




        function countTotal() {
            var total = 0;
            $('.product_item').each(function (index) {
                $(this).find('.si_bs').html(index + 1);
                let pqty = +$(this).find('.sellqty').val();
                let sellPrice = +$(this).find('.productUnitPrice').val();
                let totalsellprice = parseFloat(pqty) * parseFloat(sellPrice);
                $(this).find('.totalSellPrice').html(totalsellprice);
                total += totalsellprice;
            })
            $('#totalAmount').html(total)
            let totalDiscount = parseFloat(discountcal());
            let payable = parseFloat(total) - parseFloat(totalDiscount);

            $('#totaPayable').html(payable)

            $('#payableamoutdata').html(payable)
            $('#totalmaymentamount').val(payable)
            $('#totalpayment').val(payable)
            $('#total_payable').val(payable)
        }

        function removeItem(data) {
            $(data).parent().remove();
            countTotal();
        }

        function discountcal() {
            let type = +$('#distypeset').val();
            let total_discount = 0;
            let discountset = parseFloat($('#discountamountset').val());
            let subtotal = parseFloat($('#totalAmount').html());
            if (discountset) {
                if (type == 1) {
                    total_discount = parseFloat(subtotal * discountset) / 100;
                }
                if (type == 0) {
                    total_discount = discountset;
                }
                $('#totaDiscount').html(total_discount)
            } else {
                total_discount = 0;
                $('#totaDiscount').html('00')
            }
            return total_discount;


        }

        function plssub(data, type) {
            let sallqty = parseFloat($(data).parent().find('.sellqty').val());
            if (type == 'p') {
                $(data).parent().find('.sellqty').val(sallqty + 1);
            }
            if (type == 's') {
                $(data).parent().find('.sellqty').val(sallqty - 1);
            }
            countTotal()
        }

        $('.select2').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });


        function searchProduct(data) {
            let product_info = $(data).val();

            $.ajax({
                url: "{{route('admin.pos.product.src')}}",
                type: "get",
                data: {
                    product_info: product_info,
                },
                success: function (response) {
                    console.log(response)
                    $('#productList').html(response[1])

                    if (response[0] == 1) {
                        productInfo(response[2])
                    }
                    // countTotal();
                },
                error: function (xhr) {
                }
            });

        }

        function customeradd() {
            $('#customeradd').modal('show')

        }

        $('#customeaddSubmit').on('submit', function (event) {
            event.preventDefault();
            var name = $('#inputname').val();
            var phone = $('#inputphone').val();
            var email = $('#inputemail').val();
            var address = $('#supplier_address').val();

            $.ajax({
                url: "{{route('admin.pos.customer.add.in-pos')}}",
                type: "get",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    address: address,
                },
                success: function (response) {
                    $('#customeradd').modal('hide');
                    $('#customerlist').html(response)
                    alert('success')

                },
                error: function (xhr) {
                }
            });
        })


        $('#paymentshow').on('submit',function(event){

            $type=$('#submittype').val();
            if($type==1){
                event.preventDefault();
                $('#paymentadd').modal('show')
            }
            if($type==2){
              var customer_id=$('#customerlist').val();
                if(customer_id==1){
                    let due=parseFloat($('#totaldueamount').html());
                    if(due>0){
                        event.preventDefault();
                        alert('Due payment is not allow for walk-in customer')
                    }
                }

            }

        })


        function calculatedue(data){
            $payamount=parseFloat($(data).val());
            if(!$payamount){
                $payamount=0;
            }
            $payable=parseFloat($('#payableamoutdata').html());
            $totaldue=$payable-$payamount;
            $('#totaldueamount').html($totaldue);
            $('#totalpayment').val($payamount);

        }

        $('#store_pos_payment').on('submit',function(event){
            event.preventDefault();
            let bank_id=$('#bank_id').val();
            $('#set_bank_id').val(bank_id);
            $( "#paymentshow" ).submit();
        })

        function submittype(data){
            $('#submittype').val(data);
        }


    </script>

@endsection
