<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="VTNN - HAI LÚA">
    <meta name="keywords" content="VTNN - HAI LÚA">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/client/Logo.jpg"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Google Font -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/style.css')}}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- mega-menu --}}
    <link rel="stylesheet" href="{{ asset('client/mega-menu/css/reset.css')}}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('client/mega-menu/css/style.css')}}"> <!-- Resource style -->
	<script src="{{ asset('client/mega-menu/js/modernizr.js')}}"></script> <!-- Modernizr -->
    {{-- mega-menu --}}
    
</head>

<body>
    <!-- Page Preloder Loading -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/"><img src="/client/Logo.jpg" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>{{ Cart::count() ?? 0 }}</span></a></li>
            </ul>
            <div class="header__cart__price">Giỏ hàng: <span>{{ Cart::total() }} đ</span></div>
        </div>
        <div class="humberger__menu__widget">
            @auth   
            @if(Auth::user()->user_type=='AD')                             
            <div class="header__top__right__language">
                <i class="fa fa-user"></i>
                <div> {{ Auth::user()->name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="/admin">Trang quản trị</a></li>
                </ul>
            </div>
            @else
            <div class="header__top__right__language">
                <i class="fa fa-user"></i>
                <div> {{ Auth::user()->name }}</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Tài khoản của tôi</a></li>
                    <li><a href="#">Đổi mật khẩu</a></li>
                    <li><a href="#">Đơn hàng của tôi</a></li>
                </ul>
            </div>    
            @endif  
            <div class="header__top__right__auth">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Đăng xuất
                    </a>
                </form>
            </div>
            @else
            <div class="header__top__right__auth">
                <a href="{{ route('login') }}"> Đăng nhập</a>
            </div>
            @endauth
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="{{ request()->Is('*/') ? 'active' : '' }}"><a href="/">Trang chủ</a></li>
                <li class="{{ request()->Is('*san-pham*') ? 'active' : '' }}"><a href="/san-pham.html">Sản phẩm</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="{{ route('product_New') }}">SP mới nhất</a></li>
                        <li><a href="{{ route('product_Sold') }}">SP bán chạy</a></li>
                        <li><a href="{{ route('product_Sale') }}">SP Khuyến mãi</a></li>
                        <li><a href="{{ route('myBill') }}">Kiểm tra đơn hàng</a></li>
                    </ul>
                </li>
                <li class="{{ request()->Is('*tin-tuc*') ? 'active' : '' }}"><a href="/tin-tuc">Tin tức</a></li>
                <li class="{{ request()->Is('*lien-he*') ? 'active' : '' }}"><a href="/lien-he.html">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        @foreach ($infoPage as $info)
        <div class="header__top__right__social">
            <a href="{{ $info->facebook }}"><i class="fa fa-facebook"></i></a>
            <a href="{{ $info->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="{{ $info->twitter }}"><i class="fa fa-twitter"></i></a>
            <a href="{{ $info->telegram }}"><i class="fa fa-telegram" aria-hidden="true"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li>{{ $info->contentFirst }}</li>
            </ul>
        </div>
        @endforeach
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    @foreach ($infoPage as $info)
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li>{{ $info->contentFirst }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="{{ $info->facebook }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $info->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="{{ $info->twitter }}"><i class="fa fa-twitter"></i></a>                                
                                <a href="{{ $info->telegram }}"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                            </div>
                            @auth   
                            @if(Auth::user()->user_type=='AD')                             
                            <div class="header__top__right__language">
                                <i class="fa fa-user"></i>
                                <div> {{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="/admin">Trang quản trị</a></li>
                                </ul>
                            </div>
                            @else
                            <div class="header__top__right__language">
                                <i class="fa fa-user"></i>
                                <div> {{ Auth::user()->name }}</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{ route('profile.user') }}">Hồ sơ của tôi</a></li>
                                    <li>
                                        <form action="" method="post">
                                            @csrf
                                            <a href="{{ route('user.link.forgotPass') }}">Đổi mật khẩu</a>
                                        </form>
                                    </li>
                                    <li><a href="{{ route('myBill') }}">Đơn hàng của tôi</a></li>   
                                </ul>
                            </div>    
                            @endif             
                            <div class="header__top__right__auth">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        Đăng xuất
                                    </a>
                                </form>
                            </div>
                            @else
                            <div class="header__top__right__auth">
                                <a href="{{ route('login') }}"> Đăng nhập</a>
                            </div>
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @foreach ($infoPage as $info)
                    <div class="header__logo">
                        <a href="/"><img src="{{ $info->logo }}" alt=""></a>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{ request()->Is('*/') ? 'active' : '' }}"><a href="/">Trang chủ</a></li>
                            <li class="{{ request()->Is('*san-pham*') ? 'active' : '' }}"><a href="/san-pham.html">Sản phẩm</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="{{ route('product_New') }}">SP mới nhất</a></li>
                                    <li><a href="{{ route('product_Sold') }}">SP bán chạy</a></li>
                                    <li><a href="{{ route('product_Sale') }}">SP Khuyến mãi</a></li>
                                </ul>
                            </li>
                            <li class="{{ request()->Is('*tin-tuc*') ? 'active' : '' }}"><a href="/tin-tuc">Tin tức</a></li>
                            <li class="{{ request()->Is('*lien-he*') ? 'active' : '' }}"><a href="/lien-he.html">Liên hệ</a></li>
                            <li class="{{ request()->Is('*thoi-tiet*') ? 'active' : '' }}"><a href="/du-bao-thoi-tiet.html">Thời tiết</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="/gio-hang"><i class="fa fa-shopping-bag"></i> <span>{{ Cart::count() ?? 0 }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">Giỏ hàng: <span>{{ Cart::total() }} đ</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="cd-dropdown-wrapper">
                        <a class="cd-dropdown-trigger" href="#0">Danh mục thuốc</a>
                        <nav class="cd-dropdown">
                            <h2>Danh mục thuốc</h2>
                            <a href="#0" class="cd-close">Close</a>
                            {{-- de quy cay danh muc menu  --}}
                            @foreach ($childCategories as $cate)
                                <ul class="cd-dropdown-content">					
                                    <li class="has-children">
                                        <a href="/danh-muc/{{ $cate->id }}-{{ Str::slug($cate->name), '-'}}.html">{{ $cate->name }}</a>
                                        @if ($cate->childrents) {{--neu la Danh muc con --}}
                                            <ul class="cd-secondary-dropdown is-hidden">
                                                <li class="see-all"><a href="">Sản phẩm khác</a></li>
                                                <li class="has-children">
                                                    <ul class="is-hidden">
                                                        <li class="go-back"><a href="#0"></a></li>
                                                        @foreach ($cate->childrents as $sub_cate)
                                                            <li>
                                                                <a href="/danh-muc/{{ $sub_cate->id }}-{{ Str::slug($sub_cate->name), '-'}}.html">
                                                                    {{ $sub_cate->name }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul> <!-- .cd-secondary-dropdown -->
                                        @endif
                                    </li> <!-- .has-children -->            
                                </ul> <!-- .cd-dropdown-content -->
                            @endforeach
                        </nav> <!-- .cd-dropdown -->
                    </div> <!-- .cd-dropdown-wrapper -->
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="">                               
                                <input type="search" name="key" placeholder="Bạn muốn tìm gì?">
                                <button type="submit" class="site-btn">Tìm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            @foreach ($infoPage as $info)                                
                            <div class="hero__search__phone__text">
                                <h5>{{ $info->phone }}</h5>
                                <span>Tư vấn 24/7</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> 
    {{-- </div>
    </section> --}}
    <!-- Hero Section End -->
    