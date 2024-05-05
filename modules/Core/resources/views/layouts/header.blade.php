
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i>{{ $company["email"] }}</li>
                            <li>
                                <a href="{{ route("orders.index") }}" class="text-dark">
                                    Tra cứu đơn hàng
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            @foreach ($social_media as $key => $social)
                                <a href="{{ $social }}"><i class="fa fa-{{ $key }}"></i></a>
                            @endforeach
                        </div>
                        <div class="header__top__right__auth">
                            @auth
                                <a href="{{ route("profile.index") }}" title="Thông tin người dùng">
                                    {{ auth()->user()->username }}
                                </a>
                                <a href="{{ route("logout") }}" title="Đăng xuất">
                                    <i class="fa fa-sign-out"></i>
                                </a>
                            @endauth
                            @guest
                                <a title="Đăng nhập" href="{{ route("login") }}"><i class="fa fa-user"></i> Đăng nhập</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href ="{{ route("home") }}">
                        <img width="120px" height="50px" src="{{ $company["logo"] }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ route("home") == url()->current() ? 'active' : '' }}">
                            <a href="{{ route("home") }}">Trang chủ</a>
                        </li>
                        <li class="{{ route("products") == url()->current() ? 'active' : '' }}">
                            <a href="{{ route("products") }}">Sản phẩm</a>
                        </li>
                        <li class="{{ route("blogs") == url()->current() ? 'active' : '' }}">
                            <a href="{{ route("blogs") }}">Tin tức</a>
                        </li>
                        <li class="{{ route("contact") == url()->current() ? 'active' : '' }}">
                            <a href="{{ route("contact") }}">Liên hệ</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @auth
                            <li class="header__heart__count">
                                <a href="#">
                                    <i class="fa fa-bell"></i> 
                                    <span>0</span>
                                </a>
                            </li>
                        @endauth
                        <li class="header__cart__count">
                            <a href="{{ route("carts.index") }}">
                                <i class="fa fa-shopping-bag"></i>
                                <span>{{ $carts_quantity }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">
                        Giá: 
                        <span>{{ $carts_price }} ₫</span>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>

<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục</span>
                    </div>
                    <ul style="max-height: 500px; overflow-y: auto">
                        @forelse ($categories as $category)
                            <li>
                                <a href="{{ route("products", ["category" => $category->slug]) }}">
                                    {{ $category->name }}
                                    @if($category)
                                    @endif
                                </a>
                            </li>
                        @empty
                            <li>
                                <a href="#">Danh mục</a>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <input type="text" placeholder="Bạn muốn tìm gì?">
                            <button type="submit" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{ $company["phone"] }}</h5>
                            <span>Hỗ trợ 24/7 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>