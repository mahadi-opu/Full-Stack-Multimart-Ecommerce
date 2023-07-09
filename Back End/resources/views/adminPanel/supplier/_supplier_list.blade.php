@foreach($supplierList as $supplier)
    <option value="{{$supplier->id}}" {{$supplier->id==$supplier_id?'selected':''}}>
        {{$supplier->supplier_name}}
        <br>
        ({{$supplier->supplier_phone_one}})
    </option>
@endforeach
