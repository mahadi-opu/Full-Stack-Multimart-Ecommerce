@extends('adminPanel.layout.layout')
@section('main_content')
    <!--start page wrapper -->
    <div class="page-content">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="headst__set">
                            <h4>Shipping Rate</h4>
                        </div>
                        <form method="post" action="{{route('shipping.cost.setting.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Division</label>
                                        <select class="form-select" name="division_id" onchange="districtGet(this)">
                                            @foreach($divisionList as $division)
                                                <option
                                                    value="{{$division->id}}" {{$shippingCost->division_id==$division->id?'selected':''}}>{{$division->name}}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    @if($shippingCost->district_id)
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" name="district_id" class="form-label">District</label>
                                            <select name="district_id" class="form-select" id="districtList">
                                                <option value=""> SELECT DISTRICT</option>
                                                @foreach($districtList as $district)
                                                    <option
                                                        value="{{$district->id}}" {{$shippingCost->district_id==$district->id?'selected':''}}>{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" name="district_id" class="form-label">District</label>
                                            <select name="district_id" class="form-select" id="districtList">
                                                <option value=""> SELECT DISTRICT</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Inside Shipping
                                            Costs </label>
                                        <input type="number" name="inside_shipping_cost"
                                               value="{{$shippingCost->inside_price}}" class="form-control"
                                               id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Outside Shipping
                                            Costs </label>
                                        <input type="number" name="outside_shipping_cost"
                                               value="{{$shippingCost->outside_price}}" class="form-control"
                                               id="exampleInputPassword1">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="headst__set">
                            <h4>Currency Set</h4>
                        </div>


                        <form method="post" action="{{route('currency.setting.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Country</label>
                                        <select class="form-select" name="currency_country"
                                                onchange="currencySet(this)">
                                            @foreach($currency as $key=>$currencyList)
                                                <option stybol="{{$currency[$key]['symbol']}}"
                                                        value="{{$key}}" {{$currencyData->country_name==$key?'selected':''}}>{{$currency[$key]['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" name="district_id"
                                               class="form-label">Currency</label>
                                        <input type="text" name="currency_symbol" class="form-control"
                                               value="{{$currencyData->currency_symbol}}" id="currency">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Par Dollar Rate</label>
                                        <input type="number" name="dollar_rate" class="form-control" min="0"
                                               value="{{$currencyData->par_dollar_rate}}" step="any">
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--end page wrapper -->
@endsection
@section('css_plugins')
    <link href="{{asset('assets/adminPanel')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js_plugins')

    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/adminPanel')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
@section('js')
    <script>
        function districtGet(data) {
            let division_id = $(data).val()
            $.ajax({
                url: "{{url('admin/district/list/get')}}",
                type: "get",
                data: {
                    division_id: division_id,
                },
                success: function (response) {
                    $('#districtList').html(response)
                },
                error: function (xhr) {
                    //Do Something to handle error
                }
            });
        }

        function currencySet(data) {
            let symbol = $('option:selected', data).attr('stybol');
            $('#currency').val(symbol);

        }

    </script>

@endsection
