<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">

        {{-- logo --}}
          <a href="{{ route('vendor.index') }}"> <img alt="image"
                  src="{{ asset('dashboard_asset/assets/img/logo.png/') }}" class="header-logo" />
              <span class="logo-name">My Shop</span>
          </a>
      </div>

      <ul class="sidebar-menu">
          <li class="menu-header">Main</li>

          <li class="dropdown">
              <a href="{{ route('vendor.index') }}" class="nav-link"><i
                      data-feather="monitor"></i><span>Dashboard</span></a>
          </li>

          <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="archive"></i><span>Products</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('vendor.product') }}">My Products</a></li>
                  <li><a class="nav-link" href="{{ route('vendor.createproduct') }}">Add New</a></li>
                  {{-- <li><a class="nav-link" href="{{ route('') }}">Category</a></li> --}}
                  {{-- <li><a class="nav-link" href="">Tags</a></li> --}}
                  <li><a class="nav-link" href="">Reviews</a></li>
              </ul>
          </li>

          <li class="dropdown">
                <a href="{{ route('vendor.orders') }}" class="nav-link"><i
                      data-feather="shopping-bag"></i><span>Order</span>
                </a>
          </li>

          

          <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                      data-feather="user-check"></i><span>My Shop</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('vendor.withdrawal') }}">Withdrawal</a></li>
                  <li><a class="nav-link" href="{{ route('vendor.payment') }}">Payment</a></li>
                  <li><a class="nav-link" href="{{ route('vendor.store') }}">Store</a></li>
                  <li><a class="nav-link" href="{{ route('vendor.coupon') }}">Coupon</a></li>
              </ul>
          </li>

          <li class="dropdown">
                <a href="#" class="nav-link"><i
                      data-feather="bar-chart-2"></i><span>Report</span>
                </a>
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
              
              {{--<li class="menu-header">General</li>
              
               <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                          data-feather="mail"></i><span>massage</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ '/admin/massage' }}">Inbox</a></li>
                      <li><a class="nav-link" href="{{ 'admin/announcement' }}">Announcements</a></li>
                      <li><a class="nav-link" href="{{ 'admin/add-announcement' }}">Add Announcements</a></li>
                  </ul> 
              <li class="dropdown">
                  <a href="#" class="menu-toggle nav-link has-dropdown"><i
                          data-feather="settings"></i><span>Settings</span></a>
                  <ul class="dropdown-menu">
                      <li><a class="nav-link" href="{{ '/admin/massage' }}">Genaral</a></li>
                      <li><a class="nav-link" href="{{ 'admin/announcement' }}">Account</a></li>
                      <li><a class="nav-link" href="{{ 'admin/add-announcement' }}">Security</a></li>
                  </ul>
              </li>--}}

      </ul>
  </aside>
</div>