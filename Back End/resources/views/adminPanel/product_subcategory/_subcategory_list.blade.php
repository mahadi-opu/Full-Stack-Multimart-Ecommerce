
@foreach($subcategoryList as $subcategory)
    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
@endforeach
