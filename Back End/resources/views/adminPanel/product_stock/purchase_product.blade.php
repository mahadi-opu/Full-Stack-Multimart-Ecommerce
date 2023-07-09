@extends('adminPanel.layout.layout')
@section('main_content')
    <div class="page-content">
        <input type="hidden" id="submittype" value="1">
        <input type="hidden" id="pageNo" value="0">
        <div class="row">
            <div class="col-sm-5" style="padding: 0px;">
                <div class="leftpos">
                    <input type="text" class="form-control" oninput="searchProduct(this)" placeholder="Search Product">

                    <div class="row productListDiv" id="productList">
                    </div>
                </div>

            </div>
            <div class="col-sm-7 mt-2" style="padding: 0px;">
                <form action="{{route('purchase.payment.store')}}" method="post" id="paymentshow">
                    @csrf
                    <div class="rightpos">
                        <input type="hidden" name="total_paid" id="total_paid_amount">
                        <input type="hidden" name="total_payable" id="total_payable_amount">
                        <div class="row d-flex justify-content-center align-items-center posTopbar">
                            <div class="col-sm-8">
                                <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                                    <option value="">Choose Supplier</option>
                                    @foreach($supplierList as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->supplier_name}}
                                            ({{$supplier->supplier_phone_one}})
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-4 d-flex justify-content-end">
                            <span class="addCustomer" onclick="customeradd()"><i style="font-size: 18px;"
                                                                                 class="lni lni-circle-plus"></i> &nbsp; Supplier</span>
                            </div>
                        </div>

                        <div>
                            <div class="item_head_st">
                                <div class="si_bs2 headitemcenter"></div>
                                <div class="details_hd_bs headitemcenter">Product Info</div>
                                <div class="cost_hd_bs headitemcenter">Product Cost</div>
                                <div class="sell_hd_bs headitemcenter">Sell Price</div>
                                <div class="discount_hd_bs headitemcenter">Qty</div>
                                <div class="total_hd_bs headitemcenter">Total Cost</div>
                                <div class="crs2_bs headitemcenter"></div>

                            </div>

                        </div>
                        <div id="orderList">

                        </div>
                        <div>
                            <div class="posfooter_st">
                                <div class="purchase_footer_first">

                                </div>
                                <div class="purchase_footer_second totaltx" style="padding-left: 35px;">
                                    <span>Subtotal Total</span>
                                </div>
                                <div class="purchase_footer_third">
                                    <strong id="totalAmount">00</strong>

                                </div>
                            </div>

                            <div class="posfooter_st">
                                <div class="purchase_footer_first">
                                    <div style="display: flex;padding: 0px 10px" class="discountinput">
                                        <select name="discount_type" class="form-select" id="distypeset"
                                                onchange="countTotal()">
                                            <option value="0">Fixed</option>
                                            <option value="1">Percentage (%)</option>
                                        </select> &nbsp;
                                        <input type="number" name="total_discount" value="" id="discountamountset"
                                               oninput="countTotal()"
                                               class="form-control" placeholder="Discount">
                                    </div>

                                </div>
                                <div class="purchase_footer_second totaltx" style="padding-left: 35px;">
                                    <span>Total Discount</span>
                                </div>
                                <div class="purchase_footer_third" style="text-align: right">
                                    <strong id="totaDiscount" class="total_discount_txt">00</strong>

                                </div>
                            </div>

                            <div class="posfooter_st">
                                <div class="purchase_footer_first">

                                </div>
                                <div class="purchase_footer_second totaltx" style="padding-left: 35px;">
                                    <span>Payable Amount</span>
                                </div>
                                <div class="purchase_footer_third" style="text-align: right">
                                    <strong id="totaPayable" class="total_discount_txt">00</strong>

                                </div>
                            </div>

                            <div class="row d-flex justify-content-center mt-4">
                                <div class="col-sm-3 d-flex justify-content-center">
                                    <button type="burron" onclick="submittype(1)" class="addCustomer">Payment</button>
                                </div>

                            </div>

                        </div>

                    </div>

                </form>
            </div>
        </div>


        <div class="modal fade" id="customeradd" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="" id="customeaddSubmit">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Supplier</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6" style="border-right:1px solid #dfdada">
                                    <div class="mb-2 row">
                                        <div class="col-sm-12"><h6 class="titleheadst">Supplier Info</h6></div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="supplier_name" class="form-control"
                                                       name="supplier_name"
                                                       placeholder="Supplier Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Phone
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="supplier_phone_one" class="form-control"
                                                       name="supplier_phone_one"
                                                       placeholder="Supplier Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Phone
                                                Two
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="supplier_phone_two" class="form-control"
                                                       name="supplier_phone_two"
                                                       placeholder="Supplier Phone Two">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputname" class="col-sm-12  pr-0 col-form-label">Supplier Email
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="supplier_email" class="form-control"
                                                       name="supplier_email"
                                                       placeholder="Supplier Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="supplier_address" class="col-sm-12  pr-0 col-form-label">Supplier
                                                Address
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="supplier_address" class="form-control"
                                                          id="supplier_address" cols="10" rows="3"
                                                          placeholder="Supplier Address"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-6" style="border-right:1px solid #dfdada">
                                    <div class="col-sm-12 "><h6 class="titleheadst">Company Info</h6></div>
                                    <div class="mb-2 row">
                                        <div class="col-sm-6">
                                            <label for="company_name" class="col-sm-12  pr-0 col-form-label">Company
                                                Name
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="company_name" class="form-control"
                                                       name="company_name"
                                                       placeholder="Company Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="company_phone" class="col-sm-12  pr-0 col-form-label">Company
                                                Phone
                                                <stong class="text-danger">*</stong>
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="company_phone" class="form-control"
                                                       name="company_phone"
                                                       placeholder="Company Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="com_email" class="col-sm-12  pr-0 col-form-label">Company Email
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" id="company_email" class="form-control"
                                                       name="company_email"
                                                       placeholder="Company Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="due" class="col-sm-12  pr-0 col-form-label">Previous Due Balance
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="number" id="previous_due" class="form-control"
                                                       name="previous_due"
                                                       placeholder="Due Balance" step="any" min="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="company_address" class="col-sm-12  pr-0 col-form-label">Company
                                                Address
                                            </label>
                                            <div class="col-sm-12">
                                                <textarea name="company_address" class="form-control"
                                                          id="company_address" cols="10" rows="3"
                                                          placeholder="Company Address"></textarea>
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
                                            <select name="bank_id" id="bank_id" class="form-select">
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
                                            <input type="text" name="total_paid" id="totalmaymentamount"
                                                   oninput="calculatedue(this)" class="duepayinput form-control">
                                            <input type="hidden" name="total_payable" id="total_payable"
                                                   oninput="calculatedue(this)" class="duepayinput form-control">
                                        </div>
                                    </div>
                                    <div class="mb-2 row duerow">
                                        <div class="col-6"><span>Due Amount</span></div>
                                        <div class="col-6 payitem"><span id="totaldueamount">00</span></div>
                                    </div>
                                </div>
                                <input type="hidden" name="supplier_id" id="supplier_id_set">
                                <input type="hidden" name="total_discount" id="total_discount">
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


    </div>

@endsection
@section('css_plugins')
    select2
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2-bootstrap-5-theme%401.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    select2
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')
    <script
        src="{{asset('assets/adminPanel/plugins')}}/cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/select2/js/select2-custom.js"></script>
    select 2
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
                    url: "{{route('admin.pos.purchase.item.get')}}",
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
                let purchaseCost = +$(this).find('.productUnitCost').val();
                let totalsellprice = parseFloat(pqty) * parseFloat(purchaseCost);
                $(this).find('.totalSellPrice').html(totalsellprice);
                console.log(total)
                total += totalsellprice;
                console.log(pqty)
            })
            // alert(total);
            $('#totalAmount').html(total)
            let totalDiscount = parseFloat(discountcal());
            let payable = parseFloat(total) - parseFloat(totalDiscount);

            $('#totaPayable').html(payable)

            $('#payableamoutdata').html(payable)
            $('#totalmaymentamount').val(payable)
            $('#total_paid_amount').val(payable);
            $('#total_payable_amount').val(payable);
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
            var supplier_name = $('#supplier_name').val();
            var supplier_phone_one = $('#supplier_phone_one').val();
            var supplier_phone_two = $('#supplier_phone_two').val();
            var supplier_email = $('#supplier_email').val();
            var supplier_address = $('#supplier_address').val();
            var company_name = $('#company_name').val();
            var company_phone = $('#company_phone').val();
            var company_email = $('#company_email').val();
            var previous_due = $('#previous_due').val();
            var company_address = $('#company_address').val();

            $.ajax({
                url: "{{route('admin.supplier.store.form.purchase')}}",
                type: "get",
                data: {
                    supplier_name: supplier_name,
                    supplier_phone_one: supplier_phone_one,
                    supplier_phone_two: supplier_phone_two,
                    supplier_email: supplier_email,
                    supplier_address: supplier_address,
                    company_name: company_name,
                    company_phone: company_phone,
                    company_email: company_email,
                    previous_due: previous_due,
                    company_address: company_address,
                },
                success: function (response) {
                    $('#customeradd').modal('hide');
                    $('#supplier_id').html(response)
                    alert('success')

                },
                error: function (xhr) {
                }
            });
        })


        $('#paymentshow').on('submit', function (event) {
            $type = $('#submittype').val();
            if ($type == 1) {
                event.preventDefault();
                $('#paymentadd').modal('show')
            }
            if ($type == 2) {

            }

            // let productlist = $('#orderList').html();
            // console.log(productlist)
            // $('#productItemList').html(productlist);
            // let supplier_id = $('#supplier_id').val();
            //
            // $('#supplier_id_set').val(supplier_id)
            // $('#total_discount').val(discountcal())

        })


        function calculatedue(data) {
            $payamount = parseFloat($(data).val());
            if (!$payamount) {
                $payamount = 0;
            }
            $payable = parseFloat($('#payableamoutdata').html());
            $totaldue = $payable - $payamount;
            $('#total_paid_amount').val($payamount);
            $('#totaldueamount').html($totaldue);

        }

        $('#store_pos_payment').on('submit', function (event) {

            event.preventDefault();
            let customer_id = $('#supplier_id_set').val();
            $('#paymentshow').submit();


            // if (customer_id == 1) {
            //     let due = parseFloat($('#totaldueamount').html());
            //     // if (due > 0) {
            //     //     event.preventDefault()
            //     //     alert('Due payment is not allow for walk-in customer')
            //     // } else {
            //     //     $("#store_pos_payment").submit();
            //     // }
            //     $("#store_pos_payment").submit();
            // } else {
            //     $("#store_pos_payment").submit();
            // }
        })

        function submittype(data) {
            $('#submittype').val(data);

        }


    </script>

@endsection
