<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header d-flex justify-content-center">
        <img src="{{asset($company_info_share->company_logo) }}" class="logo-icon" alt="logo icon">
        <div>
            <h4 class="logo-text">Reinforce</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.pos.view')}}">

                <div class="menu-title">
                    <spna class="add-menu-sidebar"
                          style="display: flex;justify-content: center;align-items: center" data-toggle="modal"
                          data-target="#addOrderModalside">
                        <i class="fa fa-plus"></i>
                        <span class="nav-text text-center text-white"><i class="lni lni-circle-plus"></i>POS</span>
                    </spna>
                </div>
            </a>


        </li>

        {{--        <li class="menu-label">UI Elements</li>--}}
        <li>
            <a href="{{route('home')}}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Home</div>
            </a>
        </li>
        @if(userCanAccess('h1'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cart"></i>
                    </div>
                    <div class="menu-title">Admin Role</div>
                </a>
                <ul>
                    @if(userCanAccess('1'))
                        <li>
                            <a href="{{route('admin.role.create')}}"><i class="bx bx-right-arrow-alt"></i>Role</a>
                        </li>
                    @endif

                    @if(userCanAccess('2'))
                        <li>
                            <a href="{{route('admin.admin.create')}}"><i class="bx bx-right-arrow-alt"></i>Create Admin</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if(userCanAccess('h2'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cart"></i>
                    </div>
                    <div class="menu-title">POS</div>
                </a>
                <ul>
                    @if(userCanAccess('3'))
                        <li>
                            <a href="{{route('admin.pos.view')}}"><i class="bx bx-right-arrow-alt"></i>POS</a>
                        </li>
                    @endif
                    @if(userCanAccess('4'))
                        <li>
                            <a href="{{route('sell.list')}}"><i class="bx bx-right-arrow-alt"></i>Sell List</a>
                        </li>
                    @endif
                    {{--@if(userCanAccess('5'))--}}
                    <li>
                        <a href="{{route('admin.pos.customer.list')}}"><i class="bx bx-right-arrow-alt"></i>Pos
                            Customer List</a>
                    </li>
                    {{--@endif--}}


                </ul>
            </li>
        @endif
        @if(userCanAccess('h3'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-producthunt"></i>
                    </div>
                    <div class="menu-title">Product</div>
                </a>
                <ul>
                    @if(userCanAccess('8'))
                        <li>
                            <a href="{{route('admin.product.list')}}"><i class="bx bx-right-arrow-alt"></i>Products List</a>
                        </li>
                    @endif
                    @if(userCanAccess('5'))
                        <li><a href="{{route('admin.create.product')}}"><i class="bx bx-right-arrow-alt"></i>Add

                                Products</a>
                        </li>
                    @endif
                    @if(userCanAccess('6'))
                        <li><a href="{{route('admin.product.category')}}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                        </li>
                    @endif
                    @if(userCanAccess('7'))
                        <li>
                            <a href="{{route('admin.product.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Subcategory</a>
                        </li>
                        @endif
                        </li>

                        <li>
                            <a href="{{route('admin.product.color.show')}}"><i class="bx bx-right-arrow-alt"></i>Product
                                Color</a>
                        </li>
                        <li>
                            <a href="{{route('admin.product.size.show')}}"><i class="bx bx-right-arrow-alt"></i>Product
                                Size</a>
                        </li>
                        <li>
                            <a href="{{route('admin.product.brand')}}"><i class="bx bx-right-arrow-alt"></i>Product
                                Brand</a>
                        </li>
                </ul>
            </li>
        @endif
        @if(userCanAccess('h8'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-producthunt"></i>
                    </div>
                    <div class="menu-title">Order</div>
                </a>
                <ul>
                    {{--                <li>--}}
                    {{--                    <a href="{{route('admin.order.all')}}"><i class="bx bx-right-arrow-alt"></i>All Order</a>--}}
                    {{--                </li>--}}
                    @if(userCanAccess('15'))
                        <li>
                            <a href="{{route('admin.order.pending')}}"><i class="bx bx-right-arrow-alt"></i>Pending
                                Order</a>
                        </li>
                    @endif
                    @if(userCanAccess('16'))
                        <li>
                            <a href="{{route('admin.order.processing')}}"><i class="bx bx-right-arrow-alt"></i>Processing
                                Order</a>
                        </li>
                    @endif
                    @if(userCanAccess('17'))
                        <li>
                            <a href="{{route('admin.order.on-the-way')}}"><i class="bx bx-right-arrow-alt"></i>Order On
                                The way</a>
                        </li>
                    @endif
                    @if(userCanAccess('18'))
                        <li><a href="{{route('admin.order.cancel.request')}}"><i class="bx bx-right-arrow-alt"></i>Order
                                Cancel
                                Request</a>
                        </li>
                    @endif
                    @if(userCanAccess('19'))
                        <li><a href="{{route('admin.order.cancel.accept')}}"><i class="bx bx-right-arrow-alt"></i>Order
                                Cancel
                                Accept</a>
                        </li>
                    @endif
                    @if(userCanAccess('20'))
                        <li><a href="{{route('admin.order.cancel.completed')}}"><i class="bx bx-right-arrow-alt"></i>Cancel
                                Completed</a></li>
                    @endif
                    @if(userCanAccess('21'))
                        <li><a href="{{route('admin.order.completed')}}"><i class="bx bx-right-arrow-alt"></i>Completed
                                Order</a>
                        </li>
                    @endif
                </ul>

            </li>
        @endif
        @if(userCanAccess('h4'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-package"></i>
                    </div>
                    <div class="menu-title">Stock Products</div>
                </a>
                <ul>
                    @if(userCanAccess('9'))
                        <li>
                            <a href="{{route('admin.product.purchase')}}"><i class="bx bx-right-arrow-alt"></i>Purchase
                                Product</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route('admin.product.purchase.list')}}"><i class="bx bx-right-arrow-alt"></i>Purchase
                            List
                        </a>
                    </li>


                    {{--                @if(userCanAccess('9'))--}}
                    <li>
                        <a href="{{route('admin.supplier.list')}}"><i class="bx bx-right-arrow-alt"></i>Supplier
                            List</a>
                    </li>
                    {{--                @endif--}}
                </ul>
            </li>
        @endif
        @if(userCanAccess('h5'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-offer"></i>
                    </div>
                    <div class="menu-title">Offer Setting</div>
                </a>
                <ul>
                    @if(userCanAccess('10'))
                        <li>
                            <a href="{{route('offer.list')}}"><i class="bx bx-right-arrow-alt"></i>Create Offer</a>
                        </li>
                    @endif
                    {{--                <li>--}}
                    {{--                    <a href="{{route('admin.set.offer.product')}}"><i class="bx bx-right-arrow-alt"></i>Offer Product Select</a>--}}
                    {{--                </li>--}}
                    {{--                    @if(userCanAccess('11'))--}}
                    {{--                        <li>--}}
                    {{--                            <a href="{{route('admin.offer.product.list')}}"><i class="bx bx-right-arrow-alt"></i>Offer--}}
                    {{--                                Product--}}
                    {{--                                List</a>--}}
                    {{--                        </li>--}}
                    {{--                    @endif--}}
                </ul>
            </li>
        @endif
        @if(userCanAccess('h6'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-offer"></i>
                    </div>
                    <div class="menu-title">Setting</div>
                </a>
                <ul>
                    @if(userCanAccess('12'))
                        <li>
                            <a href="{{route('setting.company.details')}}"><i class="bx bx-right-arrow-alt"></i>Company
                                Details</a>
                        </li>
                    @endif
                    @if(userCanAccess('12'))
                        <li>
                            <a href="{{route('setting.shipping.rate')}}"><i class="bx bx-right-arrow-alt"></i>Shipping
                                Rate Set</a>
                        </li>
                    @endif
                        <li>
                            <a href="{{route('faq.view')}}"><i class="bx bx-right-arrow-alt"></i>
                                FAQ Set</a>
                        </li>
                        <li>
                            <a href="{{route('ads.view')}}"><i class="bx bx-right-arrow-alt"></i>
                                Ads Set</a>
                        </li>


                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-offer"></i>
                </div>
                <div class="menu-title">Featured Link</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('admin.featured.link.list')}}"><i class="bx bx-right-arrow-alt"></i> Featured Link
                        List </a>
                </li>
            </ul>
        </li>
        @if(userCanAccess('h7'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-home"></i>
                    </div>
                    <div class="menu-title">Bank</div>
                </a>
                <ul>
                    <li>
                        <a href="{{route('admin.bank.list')}}"><i class="bx bx-right-arrow-alt"></i>Bank List</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(userCanAccess('h9'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-stats-up"></i>
                    </div>
                    <div class="menu-title">Report</div>
                </a>
                <ul>
                    @if(userCanAccess('23'))
                        <li>
                            <a href="{{route('admin.report.sell.profit')}}"><i class="bx bx-right-arrow-alt"></i>Sell &
                                Profit Report</a>
                        </li>
                    @endif
                    @if(userCanAccess('22'))
                        <li>
                            <a href="{{route('admin.report.sell')}}"><i class="bx bx-right-arrow-alt"></i>Best Sell
                                Product Report</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
