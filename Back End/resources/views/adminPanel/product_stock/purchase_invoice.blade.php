<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Example 1</title>
{{--    <link rel="stylesheet" href="style.css" media="all" />--}}

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');
    </style>


    <style>

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            /*width: 21cm;*/
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: 'Work Sans', sans-serif;
        }
        .subtextstyle{
            font-size: 13px;
            color: #333232;
            margin-top: 3px;
        }

        header {
            padding: 10px 0;
            /*margin-bottom: 30px;*/
        }

        #logo {
            text-align: left;
            /*margin-bottom: 10px;*/
        }

        #logo img {
            width: 100px;
        }

        h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</head>
<body>
<header class="clearfix">
    <div  style="padding: 10px 20px;margin-bottom: 20px">

        <div style="text-align: center;font-size: 30px">
            <img height="100px" width="100px" src="{{ public_path($company_info_share->company_logo) }}">
        </div>
{{--        <div style="text-align: center;font-size: 30px">--}}
{{--          <h5>sldfkjs</h5>--}}
{{--        </div>--}}

    </div>
    <div id="company" style="font-size: 16px" class="clearfix">
        <div style="font-size: 30px;font-weight: 700">INVOICE</div>
        <div><span>Invoice</span>:#{{$purchase->purchase_code}}</div>
        <div class="subtextstyle"><span>Date</span>: {{ date('d/M/y',strtotime($purchase->date))  }}</div>
{{--        {{$purchase->purchaseDetails}}--}}
    </div>
    <div id="project" style="margin-top:27px;font-size: 16px">
        <div>Supplier</div>
        <br>
        <div> {{  $purchase->supplierInfo->supplier_name}}</div>
        <div class="subtextstyle">{{$purchase->supplierInfo->supplier_address}}</div>
        <div class="subtextstyle">{{$purchase->supplierInfo->supplier_phone_one}}</div>
    </div>
</header>
<main>
    <table>
        <thead>
        <tr style="background: rgba(36,36,37,0.27)">
            <th class="service">SI</th>
            <th class="desc">PRODUCT</th>
            <th>PRICE</th>
            <th>QTY</th>
            <th>TOTAL</th>
        </tr>
        <?php
            $subtotal=0;
            ?>
        </thead>
        <tbody>
        @foreach($purchaseDetails as $key=>$purchasedata)
        <tr>
            <td class="service">{{$key+1}}</td>
            <td class="desc">{{$purchasedata->productInfo->name}}</td>
            <td class="unit">
                {{$purchasedata->unit_cost}}
            </td>
            <td class="qty">{{$purchasedata->total_qty}}</td>
            <td class="total">{{$sub=round($purchasedata->purchase_payable_amount)}}</td>
                <?php
                $subtotal+=$sub;
                ?>
        </tr>
        @endforeach

        <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">{{$subtotal}}</td>
        </tr>
        <tr>
            <td colspan="4">TAX</td>
            <td class="total">00</td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">{{$subtotal}}</td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">TOTAL PAYED</td>
            <td class="grand total">{{ round($purchase->total_paid) }}</td>
        </tr>
        <tr style="background:white;border:none">
            <td colspan="4" class="grand total" style="background:white;border:none">TOTAL DUE</td>
            <td class="grand total" style="background:white;border:none">{{ round($subtotal-$purchase->total_paid) }}</td>
        </tr>
        </tbody>
    </table>

    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">
{{--            A finance charge of 1.5% will be made on unpaid balances after 30 days.--}}
        </div>
    </div>
</main>
<div style="text-align: center;margin-top:40px">
    <p>
        {{$company_info_share->name}}
        <br>
        {{$company_info_share->company_address}}
    </p>

</div>
</body>
</html>
