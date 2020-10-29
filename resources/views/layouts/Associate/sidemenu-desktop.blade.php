<div class="logo">
    <a href="#">
        <img src="/images/icon/logo.png" alt="Cool Admin" />
    </a>
</div>
<div class="menu-sidebar__content js-scrollbar1">
    <nav class="navbar-sidebar">
        <ul class="list-unstyled navbar__list">
            <li class="active has-sub">
                <a class="js-arrow" href="{{route('dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-copy"></i>User Management</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
                    <li>
                        <a href="{{url('users')}}">Users</a>
                    </li>
                    <li>
                        <a href="#">Roles</a>
                    </li>
                    <li>
                        <a href="#">Permission</a>
                    </li>
                </ul>
            </li>
            <li class="webhas-sub">
                <a class="js-arrow" href="{{route('rent.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Rents
                </a>
            </li>
            <li class="webhas-sub">
                <a class="js-arrow" href="{{route('driver.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Drivers</a>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="{{route('vehicle.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Vehicles</a>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="{{route('case.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Cases</a>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="{{route('damage.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Damages</a>
            </li>
            <li class="has-sub">
                <a class="js-arrow" href="{{route('transaction.index')}}">
                    <i class="fas fa-tachometer-alt"></i>Transactions</a>
            </li>

            <li class="has-sub">
                <a class="js-arrow" href="#">
                    <i class="fas fa-desktop"></i>Inventory</a>
                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                    <li class="has-sub @if(Request::is('category/*')) active @endif">
                        <a href="{{route('category.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Category</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub @if(Request::is('stock/*')) active @endif">
                        <a href="{{route('stock.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Stock/Product</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub @if(Request::is('supplier/*')) active @endif">
                        <a href="{{route('supplier.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Supplier</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub @if(Request::is('supplier/*')) active @endif">
                        <a href="{{route('supplier.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Supplier</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>
                    <li class="has-sub @if(Request::is('purchase/*')) active @endif">
                        <a href="{{route('purchase.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Purchase</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <li class="has-sub @if(Request::is('sales/*')) active @endif">
                        <a href="{{route('sales.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Sales</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>

                    <li class="has-sub @if(Request::is('customer/*')) active @endif">
                        <a href="{{route('customer.index')}}">
                            <i class="fa fa-shopping-bag"></i> <span>Customer</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    </li>


                </ul>
            </li>
        </ul>

    </nav>
</div>


