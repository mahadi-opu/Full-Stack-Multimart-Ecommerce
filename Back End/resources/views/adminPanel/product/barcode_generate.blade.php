<!DOCTYPE html>
<html>
<head>
    <title>How to Generate Bar Code in Laravel? - ItSolutionStuff.com</title>

  <style>
      .tdst{
          width: 30%;
          padding: 0px 20px;
          border:1px solid black;
          margin:3px 4px;
      }
      .productname{
          padding:0px;
          font-size: 12px;
          font-weight: bold;
      }
  </style>
</head>
<body>

{{--<h1>How to Generate Bar Code in Laravel? - ItSolutionStuff.com</h1>--}}


{{--<h3>Product: {{$product->code}}</h3>--}}
@php

    $i=0;
//    $generator = new Picqer\
@endphp
<?php   $generator = new Picqer\Barcode\BarcodeGeneratorHTML(); ?>
<table>
    <tbody>
        @while($i<$qty)


            <tr>
                <td class="tdst">
                    <span class="productname">{{$product->name}}</span>
                    {!! $generator->getBarcode($product->code, $generator::TYPE_CODE_128) !!}
                    <span class="productname">Price:{{$product->current_sale_price}}</span>
                </td>
                <td class="tdst">
                    <span class="productname">{{$product->name}}</span>
                    {!! $generator->getBarcode($product->code, $generator::TYPE_CODE_128) !!}
                    <span class="productname">Price:{{$product->current_sale_price}}</span>
                </td>
                <td class="tdst">
                    <span class="productname">{{$product->name}}</span>
                    {!! $generator->getBarcode($product->code, $generator::TYPE_CODE_128) !!}
                    <span class="productname">Price:{{$product->current_sale_price}}</span>
                </td>
                <td class="tdst">
                    <span class="productname">{{$product->name}}</span>
                    {!! $generator->getBarcode($product->code, $generator::TYPE_CODE_128) !!}
                    <span class="productname">Price:{{$product->current_sale_price}}</span>
                </td>
            </tr>


                <?php $i+=4 ?>

        @endwhile

    </tbody>
</table>




{{--@while($qty>0)--}}
{{--    {!! $generator->getBarcode('0001245259636', $generator::TYPE_CODE_128) !!}--}}
{{--    --}}
{{--    <?php--}}
{{--        $qty-=1;--}}
{{--        ?>--}}
{{--@endwhile--}}






{{--<h3>Product 2: 000005263635</h3>--}}
{{--@php--}}
{{--    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();--}}
{{--@endphp--}}

{{--<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128)) }}">--}}
</body>
</html>
