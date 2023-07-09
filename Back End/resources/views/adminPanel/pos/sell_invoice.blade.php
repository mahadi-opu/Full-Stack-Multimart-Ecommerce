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
    <div  style="background: #e9e9e9;padding: 10px 20px;margin-bottom: 20px">

        <div style="text-align: center;font-size: 30px">
            <img src="{{ public_path('storage/logo/companylogo.png') }}">
        </div>

    </div>
    <div id="company" style="font-size: 16px" class="clearfix">
        <div style="font-size: 30px;font-weight: 700">INVOICE</div>
        <div><span>Invoice</span>:#{{$sell->invoice_id}}</div>
        <div class="subtextstyle"><span>Date</span>: {{ date('d/M/y',strtotime($sell->date))  }}</div>
    </div>
    <div id="project" style="margin-top:27px;font-size: 16px">
        <div> {{$sell->customer->name}}</div>
        <div class="subtextstyle">{{$sell->customer->address}}</div>
        <div class="subtextstyle">{{$sell->customer->phone}}</div>
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
        @foreach($sell->sellDetail as $key=>$sellData)
        <tr>
            <td class="service">{{$key+1}}</td>
            <td class="desc">{{$sellData->productInfo->name}}</td>
            <td class="unit">
                {{$sellData->productInfo->current_sale_price-$sellData->total_discount}}

            </td>
            <td class="qty">{{$sellData->sale_quantity}}</td>
            <td class="total">{{$sub=$sellData->total_payable_amount*$sellData->sale_quantity}}</td>
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
        </tbody>
    </table>
    <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div>
</main>
<footer>
    Invoice was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>
