<div class="item_st product_item">
    <input type="hidden" name="product_id[]" class="item_product_id" value="{{$productinfo->id}}" >
{{--    <input type="hidden" name="product_unit_price[]" value="{{$productinfo->current_sale_price}}">--}}
{{--    <input type="hidden" name="product_discount[]" value="{{$discount}}" >--}}
{{--    <input type="hidden" name="product_cost[]" value="{{$productinfo->current_purchase_cost}}" >--}}

    <div class="si_bs headitemcenter">1</div>
    <div class="details2_bs">
        <div class="itst">
            <img class="pimgst"
                 src="{{asset($productinfo->image_path)}}"
                 alt="">
        </div> &nbsp;&nbsp;
        <div>
            <span>{{$productinfo->name}}</span> <br>
            <strong>Price:</strong> <span>{{$productinfo->current_sale_price}}</span>
        </div>
    </div>
    <div class="cost_bs  "><input class="qtyst  inputitemst productUnitCost"  name="unit_cost[]" oninput="countTotal()" type="number" value="{{$productinfo->current_purchase_cost}}" required></div>
    <div class="sell_bs headitemcenter"><input class="qtyst  inputitemst" name="sellPrice[]" oninput="countTotal()" type="text" value="{{$productinfo->current_sale_price}}"></div>
    <div class="discount2_bs headitemcenter">
        <div>
            <button type="button" class="btn plussub" onclick="plssub(this,'p')">+</button>
            <span class="numberitem">
              <input class="qtyst sellqty" name="sell_qty[]" oninput="countTotal()" type="text" value="1">
            </span>
            <button type="button" class="btn plussub" onclick="plssub(this,'s')">-</button>
        </div>
    </div>
    <div class="total2_bs headitemcenter">
        <input type="hidden" class="productUnitPrice" name="product_sell_price[]"
               value="{{$productinfo->current_sale_price-$discount}}">
        <strong class="totalSellPrice">{{$productinfo->current_sale_price-$discount}}</strong>
    </div>
    <div class="crs2_bs headitemcenter" onclick="removeItem(this)">
                                   <span class="crosst">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-x text-primary">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </span>
    </div>

</div>
