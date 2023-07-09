<div>
    <div class="row">


        <div class="col-sm-6">
            <h5>Shipping Address</h5>
            <ul class="shipping shipping__st">
                <li>{{$orderList->orderAddress->name}}</li>
                <li>{{$orderList->orderAddress->shipping_address}}</li>
                <li>Phone:{{$orderList->orderAddress->shipping_phone}}</li>
                <li>Email:{{$orderList->orderAddress->email}}</li>
            </ul>
        </div>
        <div class="col-sm-6">
            <h4 class="textRight  mrgst">INVOICE</h4>
            <div class="col-sm-12 tx-al-rt mb-3">
                <strong class="inv__id">#{{$orderList->invoice_id}}</strong>
                <br>
                Date:{{ date('d-M-Y',strtotime($orderList->date))}}
            </div>

        </div>
{{--        <div class="col-sm-6 tx-al-rt">--}}
{{--            <h5>Billing Address</h5>--}}
{{--                <ul class="billing__st">--}}
{{--                    <li>{{$orderList->orderAddress->billing_first_name}} {{$orderList->orderAddress->billing_last_name}}</li>--}}
{{--                    <li>{{$orderList->orderAddress->billing_address}}</li>--}}
{{--                    <li>Phone:{{$orderList->orderAddress->billing_phone}}</li>--}}
{{--                    <li>Email:{{$orderList->orderAddress->billing_email}}</li>--}}
{{--                </ul>--}}
{{--        </div>--}}
    </div>
    <div class="col-sm-12">

        <table class="table table-borderless">
            <thead class="bgclset">
            <tr>
                <th class="imgthst">SI</th>
                <th class="imgthst">IMG</th>
                <th class="itemNamePrc">Name</th>
                <th class="itemprc">QTY</th>
                <th class="itemprc">UNIT PRICE</th>
                <th class="itemtotalprc">TOTAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $orderList->sellDetail as $key=>$item)
            <tr>
                <td>{{$key+1}}</td>
                <td><img class="item_img_st" src="{{asset($item->productInfo->image_path)}}" alt="">  </td>
                <td>{{$item->productInfo->name}}</td>
                <td>{{$item->sale_quantity}}</td>
                <td>{{round($item->unit_sell_price-$item->total_discount)}}
                    <br>
                    <span class="dis__st">Discount:{{round($item->total_discount)}}</span>
                </td>
                <td class="tx-al-rt">{{round($item->total_payable_amount)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td class="tx-al-rt">SUBTOTAL</td>
                <td class="tx-al-rt">{{round($orderList->total_payable_amount)}}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td class="tx-al-rt"> SHIPPING RATE</td>
                <td class="tx-al-rt">{{$shipping=round($orderList->shipping_cost)}}</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td class="tx-al-rt">VAT</td>
                <td class="tx-al-rt">00</td>
            </tr>
            <tr class="border__topst">
                <td colspan="4"></td>
                <td class="tx-al-rt">TOTAL</td>
                <td class="tx-al-rt"> <strong>{{round($orderList->total_payable_amount+$shipping)}}</strong></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-sm-6">
        <label>Order Note</label>
        <textarea class="form-control"></textarea>
    </div>
</div>
