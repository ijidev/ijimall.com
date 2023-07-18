@php
    $pendingOrder = App\Models\Order::where('status','pending')->count() ;
    $pendingProduct = App\Models\Product::where('status','pending')->count() ;
    $pendingWithdrawal = App\Models\Withdrawal::where('status','pending')->count() ;
    $pendingShop = App\Models\Shop::where('is_active', 0 )->count() ;
    $vendorNotifyCount = $pendingShop + $pendingWithdrawal;
    $route = Route::CurrentRouteName();
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ '/admin/dashboard' }}"> <img alt="image"
                    src="{{ asset('dashboard_asset/assets/img/logo.png/') }}" class="header-logo" />
                <span class="logo-name">Admin Panel</span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if ($route == 'admin.dashboard')  active @endif">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            <li class="dropdown 
                @if ($route == 'admin.products')  active
                @elseif ($route == 'admin.addproduct') active
                @elseif ($route == 'admin.categories') active @endif
            ">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="archive"></i><span>Products
                        @if ($pendingProduct >= 1)
                            <b class=" badge badge-danger mr-3">
                                {{ $pendingProduct }}
                            </b>
                        @endif
                    </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'admin.products' ?  'active' : '' }}"><a class="nav-link" href="{{ route('admin.products') }}">All Products
                        @if ($pendingProduct >= 1)
                            <b class=" badge headerBadge1 bg-orange">
                                {{ $pendingProduct }}
                            </b>
                        @endif
                    </a></li>

                    <li class="{{ $route == 'admin.addproduct' ?  'active' : '' }}">
                        <a class="nav-link"href="{{ route('admin.addproduct') }}">Add Product</a>
                    </li>
                    <li class="{{ $route == 'admin.categories' ?  'active' : '' }}">
                        <a class="nav-link"href="{{ route('admin.categories') }}">Category</a>
                    </li>
                    <li><a class="nav-link" href="">Tags</a></li>
                    <li><a class="nav-link" href="">Reviews</a></li>
                </ul>
            </li>

            <li class="dropdown @if ($route== 'admin.orders')  active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="shopping-bag"></i><span>Order
                        @if ($pendingOrder >= 1)
                            <b class=" badge badge-danger mr-3">
                                {{ $pendingOrder }}
                            </b>
                        @endif

                    </span>
                    
                </a>

                <ul class="dropdown-menu">
                    <li class="@if ($route == 'admin.orders')  active @endif"> <a class="nav-link" href="{{ route('admin.orders') }}">Orders
                        @if ($pendingOrder >= 1)
                            <b class=" badge headerBadge1 bg-orange">
                                {{ $pendingOrder }}
                            </b>
                        @endif
                    </a></li>
                    {{-- <li><a class="nav-link" href="{{ route('vendor.order') }}">Sub Orders</a></li> --}}
                    <li><a class="nav-link" href="{{ '' }}">Completed</a></li>
                    {{-- <li><a class="nav-link" href="{{ '/admin/tags' }}">Tags</a></li> --}}
                </ul>
            </li>

            <li class="dropdown
                @if ($route == 'admin.users')  active
                @elseif ($route == 'admin.user.add') active
                {{-- @elseif ($route == 'admin.categories') active  --}}
                @endif
            ">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'admin.users' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="{{ $route == 'admin.user.add' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.user.add') }}">Add User</a>
                    </li>
                    {{-- <li><a class="nav-link" href="{{ '/admin/orders/completed' }}">Completed</a></li> --}}
                    {{-- <li><a class="nav-link" href="{{ '/admin/tags' }}">Tags</a></li> --}}
                </ul>
            </li>

            <li class="dropdown
                @if ($route == 'admin.shopIndex')  active
                @elseif ($route == 'withdrawal.request') active @endif
            "><a href="#" class="menu-toggle nav-link has-dropdown"><i
                    data-feather="user-check"></i><span>Vendors
                        @if ($vendorNotifyCount >= 1)
                        <b class=" badge badge-danger mr-3">
                            {{ $vendorNotifyCount }}
                        </b>
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ $route == 'admin.shopIndex' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.shopIndex') }}">Shops
                        @if ($pendingShop >= 1)
                            <b class=" badge headerBadge1 bg-orange">
                                {{ $pendingShop }}
                            </b>
                        @endif
                    </a></li>
                    {{-- <li><a class="nav-link" href="{{ '/admin/Vendors' }}">All Vendors</a></li> --}}
                    <li><a class="nav-link" href="{{ '/admin/add-vendor' }}">Add Vendor</a></li>
                    <li><a class="nav-link" href="{{ '/admin/vendor-shipping' }}">Shipping</a></li>
                    <li><a class="nav-link" href="{{ '/admin/inspection' }}">Inspection</a></li>
                    <li class="{{ $route == 'withdrawal.request' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('withdrawal.request') }}">Withdrawal 
                        @if ($pendingWithdrawal >= 1)
                            <b class=" badge headerBadge1 bg-orange">
                                {{ $pendingWithdrawal }}
                            </b>
                        @endif
                    </a></li>
                    <li><a class="nav-link" href="{{ '/admin/vendor-setting' }}">Settings</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="bar-chart-2"></i><span>Report</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ '/admin/sales-report' }}">Sales Report</a></li>
                    <li><a class="nav-link" href="{{ '/admin/vendor-report' }}">Vendor Report</a></li>
                    <li><a class="nav-link" href="{{ '/admin/customer-report' }}">Customer Report</a></li>
                    {{-- <li><a class="nav-link" href="{{ '/admin/tags' }}">Tags</a></li> --}}
                </ul>
            </li>

            <li class="menu-header">Massage</li>

            <li>
                <a href="{{ '/admin/inbox' }}" class="nav-link"><i
                    data-feather="message-circle"></i><span>Indox</span></a>
            </li>

            <li>
                <a href="{{ '/admin/dashboard' }}" class="nav-link"><i
                        data-feather="flag"></i><span>Abuse Report</span></a>    
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="bell"></i><span>Announcements</span></a>
                <ul class="dropdown-menu">
                    {{-- <li><a class="nav-link" href="{{ '/admin/massage' }}">Inbox</a></li> --}}
                    <li><a class="nav-link" href="{{ 'admin/announcement' }}">Announcements</a></li>
                    <li><a class="nav-link" href="{{ 'admin/add-announcement' }}">Add Announcements</a></li>
                </ul>
                
                <li class="menu-header">General</li>
                
                {{-- <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="mail"></i><span>massage</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ '/admin/massage' }}">Inbox</a></li>
                        <li><a class="nav-link" href="{{ 'admin/announcement' }}">Announcements</a></li>
                        <li><a class="nav-link" href="{{ 'admin/add-announcement' }}">Add Announcements</a></li>
                    </ul> --}}
                <li class="dropdown 
                @if ($route == 'admin.setting')  active
                {{-- @elseif ($route == 'admin.addproduct') active  --}}
                @endif">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="settings"></i><span>Settings</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ $route == 'admin.setting' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('admin.setting') }}">Genaral</a>
                        </li>
                        <li><a class="nav-link" href="{{ 'admin/announcement' }}">Account</a></li>
                        <li><a class="nav-link" href="{{ 'admin/add-announcement' }}">Security</a></li>
                    </ul>

        </ul>
    </aside>
</div>