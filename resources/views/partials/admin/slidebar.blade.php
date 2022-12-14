<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/category', 'admin/category/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-category"
                aria-expanded="{{ Request::is('admin/category') ? 'true' : '' }}" aria-controls="ui-category">
                <i class="mdi mdi-dns menu-icon"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/category', 'admin/category/create') ? 'show' : '' }}"
                id="ui-category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category') ? 'active' : '' }}"
                            href="{{ route('category.index') }}">View Category</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/category/create') ? 'active' : '' }}"
                            href="{{ route('category.create') }}">Add Category</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/product', 'admin/product/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-product"
                aria-expanded="{{ Request::is('admin/product') ? 'true' : '' }}" aria-controls="ui-product">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/product', 'admin/product/create') ? 'show' : '' }}"
                id="ui-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/product') ? 'active' : '' }}" href="{{ route('product.index') }}">View Product</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/product/create') ? 'active' : '' }}" href="{{ route('product.create') }}">Add Product</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item {{ Request::is('admin/brand', 'admin/brand/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-brand"
                aria-expanded="{{ Request::is('admin/brand') ? 'true' : '' }}"
                aria-controls="ui-brand">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Brands</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/brand', 'admin/brand/create') ? 'show' : '' }}"
                id="ui-brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/brand') ? 'active' : '' }}" href="{{ route('brand.index') }}">View Brand</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/brand/create') ? 'active' : '' }}" href="{{ route('brand.create') }}">Add Brand</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/coupon', 'admin/coupon/create') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-coupon"
                aria-expanded="{{ Request::is('admin/coupon') ? 'true' : '' }}"
                aria-controls="ui-coupon">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Coupons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/coupon', 'admin/coupon/create') ? 'show' : '' }}"
                id="ui-coupon">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/coupon') ? 'active' : '' }}" href="{{ route('coupon.index') }}">View coupon</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/coupon/create') ? 'active' : '' }}" href="{{ route('coupon.create') }}">Add coupon</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/color', 'admin/color/create') ? 'active' : '' }}"">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-color" aria-expanded="{{ Request::is('admin/color') ? 'true' : '' }}"
                aria-controls="ui-color">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Colors</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/color', 'admin/color/create') ? 'show' : '' }}" id="ui-color">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/color') ? 'active' : '' }}" href="{{ route('color.index') }}">View Color</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/color/create') ? 'active' : '' }}" href="{{ route('color.create') }}">Add Color</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/size', 'admin/size/create') ? 'active' : '' }}"">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-size" aria-expanded="{{ Request::is('admin/size') ? 'true' : '' }}"
                aria-controls="ui-size">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Sizes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/size', 'admin/size/create') ? 'show' : '' }}" id="ui-size">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/size') ? 'active' : '' }}" href="{{ route('size.index') }}">View size</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/size/create') ? 'active' : '' }}" href="{{ route('size.create') }}">Add size</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/slider', 'admin/slider/create') ? 'active' : '' }}"">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-slider" aria-expanded="{{ Request::is('admin/slider') ? 'true' : '' }}"
                aria-controls="ui-slider">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Sliders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/slider', 'admin/slider/create') ? 'show' : '' }}" id="ui-slider">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/slider') ? 'active' : '' }}" href="{{ route('slider.index') }}">View slider</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/slider/create') ? 'active' : '' }}" href="{{ route('slider.create') }}">Add slider</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/order', 'admin/order-history', 'admin/view-order/*') ? 'active' : '' }}"">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-order" aria-expanded="{{ Request::is('admin/order') ? 'true' : '' }}"
                aria-controls="ui-order">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/order', 'admin/order-history', 'admin/view-order/*') ? 'show' : '' }}" id="ui-order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/order') ? 'active' : '' }}" href="{{ route('order.index') }}">View orders</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/order-history') ? 'active' : '' }}" href="{{ route('order.history') }}">Orders history</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ Request::is('admin/sale', 'admin/sale/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('sale.index') }}">
                <i class="mdi mdi-sale menu-icon"></i>
                <span class="menu-title">Sales</span>
            </a>
        </li>

        <li class="nav-item {{ Request::is('admin/user', 'admin/view-user/*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" aria-expanded="{{ Request::is('admin/user') ? 'true' : '' }}"
                aria-controls="ui-color">
                <i class="mdi mdi-tag-multiple menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/user', 'admin/view-user/*') ? 'show' : '' }}" id="ui-user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::is('admin/user/*') ? 'active' : '' }}" href="{{ route('user.index') }}">View User</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link {{ Request::is('admin/admin/view-user/*') ? 'active' : '' }}" href="{{ route('user.view') }}">Add Color</a></li> --}}
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Setting</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
