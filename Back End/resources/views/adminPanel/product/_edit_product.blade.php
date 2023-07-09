<div class="row">
    <div class="col-lg-8">
        <div class="border border-3 p-4 rounded">
            <div class="row">
                <div class="col-sm-6">
                    <input type="hidden" name="product_id" value="{{$productInfo->id}}">
                    <div class="mb-3">
                        <label for="inputProductTitle" class="form-label">Product Name
                            <strong class="text-danger">*</strong> </label>
                        <input type="text" class="form-control" name="name"
                               value="{{$productInfo->name}}"
                               id="inputProductTitle"
                               placeholder="Enter product Name" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product
                            Category <strong class="text-danger">*</strong> </label>
                        <select class="form-select" onchange="getSubcategory(this)"
                                name="category_id" id="single-select-field"
                                data-placeholder="Choose Category" required>
                            <option></option>
                            @foreach($productCategory as $category)
                                <option
                                    value="{{$category->id}}" {{$category->id==$productInfo->category_id?'selected':''}}>{{$category->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-2">
                        <label for="single-select-field" class="form-label">Product
                            Subcategory</label>
                        <select class="form-select select2 " id="subcategory_id"
                                name="subcategory_id"
                                data-placeholder="Choose Subcategory">
                            <option></option>
                            @foreach($productSubcategory as $subcategory)
                                <option
                                    value="{{$subcategory->id}}" {{$subcategory->id==$productInfo->subcategory_id?'selected':''}}>{{$subcategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="inputProductType" class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-select select2"
                            id="inputProductType"
                            data-placeholder="Choose supplier">
                        <option></option>
                        @foreach($supplierList as $supplier)
                            <option
                                value="{{$supplier->id}}" {{$supplier->id==$productInfo->supplier_id?'selected':''}}>{{$supplier->supplier_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-6">

                    <label for="inputProductType" class="form-label">Color</label>
                    <div class="colorinputdiv" id="color">
                        @foreach(explode(",",$productInfo->color) as $data)
                            <span><input type="color" name="product_color[]" class="form-control form-control-color"
                                         id="exampleColorInput" value="{{$data}}" title="Choose your color"></span>
                        @endforeach

                    </div>
                    <div class="addcoilorbtndiv">
                        <div class="addcolorbtn" onclick="addnewcolor()">+</div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <input type="text" id="myInput" name="size" class="form-control" data-role="tagsinput"
                               value="{{$productInfo->size}}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="inputProductDescription" class="form-label">Description</label>
                        <textarea class="form-control" name="description"
                                  id="inputProductDescription"
                                  rows="3">{{$productInfo->description}}</textarea>
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <label for="inputProductDescription" class="form-label">Product
                    Photo</label>
                <input style="display:none" type="file" name="image" class="image">
                <div class="row" id="productImglist">
                    <div class="col-sm-3 mb-2" style="position:relative" id="222"
                    >
                        <span class="text-center mainphototxt">Main Photo</span>
                        <span class="imgdeletebtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash text-primary"><polyline
                                    points="3 6 5 6 21 6"></polyline><path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span>
                        &nbsp;
                        <span class="imgeditbtn" onclick="selectImage('222')"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                   width="16" height="16"
                                                                                   viewBox="0 0 24 24" fill="none"
                                                                                   stroke="currentColor"
                                                                                   stroke-width="2"
                                                                                   stroke-linecap="round"
                                                                                   stroke-linejoin="round"
                                                                                   class="feather feather-edit text-primary"><path
                                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>
                        &nbsp;
                        <input type="hidden" name="main_image" value="{{$productInfo->image_path}}" class="222input">
                        <div
                            class="imgaddcard d-flex justify-content-center align-items-center 222view ">
                            <img class="imgaddborder" src="{{asset($productInfo->image_path)}}" width="100%" alt="">
                        </div>
                    </div>
                    @foreach($productInfo->productImage as $image)
                        <div class="col-sm-3 mb-2" style="position:relative" id="{{$image->id}}">
                            <span class="imgdeletebtn" onclick="deleteItem({{$image->id}})"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-trash text-primary"><polyline
                                        points="3 6 5 6 21 6"></polyline><path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></span>

                            <span class="imgeditbtn" onclick="selectImage({{$image->id}})"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-edit text-primary"><path
                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path
                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span>

                            <input type="hidden" name="editImage[{{$image->id}}][]" class="{{$image->id}}input">
                            <div
                                class="imgaddcard d-flex justify-content-center align-items-center {{$image->id}}view ">
                                <img class="imgaddborder" src="{{asset($image->image)}}" width="100%" alt="">
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                            <span onclick="addNewImage()" class="btn btn-success"
                                  style="  padding: 7px 7px;border-radius: 100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-plus text-primary"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="border border-3 p-4 rounded">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="inputCostPerPrice" class="form-label">Purchase
                        Cost</label>
                    <input type="number" name="current_purchase_cost"
                           value="{{$productInfo->current_purchase_cost}}"
                           class="form-control" id="inputCostPerPrice"
                           placeholder="00.00">

                </div>
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Sell Price <strong
                            class="text-danger">*</strong> </label>
                    <input type="number" name="current_sale_price"
                           value="{{$productInfo->current_sale_price}}" class="form-control"
                           id="inputPrice" placeholder="00.00" required>
                </div>
                <div class="col-md-6">
                    <label for="inputCompareatprice" class="form-label">Wholesale
                        Price</label>
                    <input type="number" name="current_wholesale_price"
                           value="{{$productInfo->current_wholesale_price}}"
                           class="form-control"
                           id="wholesalepricce" placeholder="00.00">
                </div>

                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Wholesale
                        Qty </label>
                    <input type="number" name="wholesale_minimum_qty"
                           class="form-control"
                           value="{{$productInfo->wholesale_minimum_qty}}"
                           id="inputStarPoints" placeholder="00.00">
                </div>
                <div class="col-md-6">
                    <label for="inputStarPoints" class="form-label">Discount Type </label>
                    <select name="discount_type" class="form-control" id="" onchange="discountType(this)">
                        <option value="0">Fixed</option>
                        <option value="1">Percentage (%)</option>
                    </select>
                </div>
                @if($productInfo->discount_type==0)
                    <div class="col-md-6" id="discount">
                        <label for="inputStarPoints" class="form-label">Discount Amount</label>
                        <input type="number" name="discount" value="{{$productInfo->discount}}" class="form-control"
                               placeholder="Amount">
                    </div>
                @endif
                @if($productInfo->discount_type==1)
                    <div class="col-md-6" id="discount">
                        <label for="inputStarPoints" class="form-label">Discount (%)</label>
                        <input type="number" name="discount" value="{{$productInfo->discount}}" class="form-control"
                               placeholder="Percentage (%)" required>
                    </div>
                @endif


                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="is_trending"
                               type="checkbox"
                               {{$productInfo->is_trending==1?'checked':''}}
                               value="1" id="flexCheckDisabled">
                        <label class="form-check-label" for="flexCheckDisabled">
                            Is Trending
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" name="is_popular"
                               type="checkbox"
                               value="1" id="flexCheckDisabled" {{$productInfo->is_popular==1?'checked':''}}>
                        <label class="form-check-label" for="flexCheckDisabled">
                            Is Popular
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->

