
<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<!--header-->
<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item" >
                                <a title="Hotline: (+123) 456 789" href="#" ><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            @if (Route::has('login'))
                                @auth
                                    @if (Auth::user()->role == '1')
                                    <li class="menu-item menu-item-has-children parent" >
                                        <a  href="#">Hi, {{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <ul class="submenu curency" >
                                            <li class="menu-item" >
                                                <a title="" href="{{ route('dashboard') }}">Go to dashboard</a>
                                            </li>
                                            <li class="menu-item" >
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                    @else
                                        <li class="menu-item menu-item-has-children parent" >
                                            <a  href="#">Hi, {{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                            <ul class="submenu curency" >
                                                <li class="menu-item" >
                                                    <a title="" href="{{ route('frontend.user.profile') }}">My Account</a>
                                                </li>
                                                <li class="menu-item" >
                                                    <a href="{{ route('frontend.order.view') }}">My Orders</a>
                                                </li>
                                                <li class="menu-item">
                                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </li>
                                    @endif
                                @else
                                    <li class="menu-item" ><a title="Register or Login" href="{{ route('login') }}">Login</a></li>
                                    <li class="menu-item" ><a title="Register or Login" href="{{ route('register') }}">Register</a></li>
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="mid-section main-info-area">

                    <div class="wrap-logo-top left-section">
                        <a href="index.html" class="link-to-home"><img src="{{ asset('assets/images/logo-top-1.png') }}" alt="mercado"></a>
                    </div>

                    <div class="wrap-search center-section">
                        <div class="wrap-search-form">
                            <form action="{{ url('search-product') }}" method="Get">
                                <input type="search" name="search" id="search_product" placeholder="Search here...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                                {{-- <div class="wrap-list-cate">
                                    <input type="hidden" name="product-cate" value="0" id="product-cate">
                                    <a href="#" class="link-control">All Category</a>
                                    <ul class="list-cate">
                                        <li class="level-0">All Category</li>
                                        <li class="level-1">-Electronics</li>
                                        <li class="level-2">Batteries & Chargens</li>
                                        <li class="level-2">Headphone & Headsets</li>
                                        <li class="level-2">Mp3 Player & Acessories</li>
                                        <li class="level-1">-Smartphone & Table</li>
                                        <li class="level-2">Batteries & Chargens</li>
                                        <li class="level-2">Mp3 Player & Headphones</li>
                                        <li class="level-2">Table & Accessories</li>
                                        <li class="level-1">-Electronics</li>
                                        <li class="level-2">Batteries & Chargens</li>
                                        <li class="level-2">Headphone & Headsets</li>
                                        <li class="level-2">Mp3 Player & Acessories</li>
                                        <li class="level-1">-Smartphone & Table</li>
                                        <li class="level-2">Batteries & Chargens</li>
                                        <li class="level-2">Mp3 Player & Headphones</li>
                                        <li class="level-2">Table & Accessories</li>
                                    </ul>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                    <Style>
                        .mg-top {
                            margin-top: 10px;
                        }
                    </Style>
                    <div class="wrap-icon right-section">
                        <div class="wrap-icon-section wishlist">
                            <a href="{{ route('frontend.wishlist.index') }}" class="link-direction">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                <div class="left-info mg-top">
                                {{-- <span class="index wishlist-count">0</span> --}}
                                    <span class="title">Wishlist</span>
                                </div>
                            </a>
                        </div>

                        <div class="wrap-icon-section minicart">
                            <a href="{{ route('frontend.cart.view') }}" class="link-direction">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <div class="left-info mg-top">
                                    {{-- <span class="index cart-count">0</span> --}}
                                    <a href="{{ route('frontend.cart.view') }}" class="title">CART</a>
                                </div>
                            </a>
                        </div>
                        <div class="wrap-icon-section show-up-after-1024">
                            <a href="#" class="mobile-navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="header-nav-section">
                    <div class="container">
                        <ul class="nav menu-nav clone-main-menu" id="mercado_haead_menu" data-menuname="Sale Info" >
                            <li class="menu-item"><a href="#" class="link-term">Weekly Featured</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Hot Sale items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top new items</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top Selling</a><span class="nav-label hot-label">hot</span></li>
                            <li class="menu-item"><a href="#" class="link-term">Top rated items</a><span class="nav-label hot-label">hot</span></li>
                        </ul>
                    </div>
                </div>

                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu" >
                            <li class="menu-item home-icon">
                                <a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li>
                            <li class="menu-item">
                                <a href="about-us.html" class="link-term mercado-item-title">About Us</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('frontend.products')}}" class="link-term mercado-item-title">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('frontend.cart.view') }}" class="link-term mercado-item-title">Cart</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('frontend.checkout.view') }}" class="link-term mercado-item-title">Checkout</a>
                            </li>
                            <li class="menu-item">
                                <a href="contact-us.html" class="link-term mercado-item-title">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
