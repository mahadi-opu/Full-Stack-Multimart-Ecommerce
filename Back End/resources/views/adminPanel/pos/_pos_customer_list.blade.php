@foreach($posCustomerList as $customer)
    <option value="{{$customer->id}}" {{$customer->id==$customer_id?'selected':''}}>{{$customer->name}}</option>
@endforeach
