<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset("assets/img/logo.png") }}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            @auth
                <li>
                    <a href="#">
                        <i class="fa fa-bell"></i> 
                        <span>1</span>
                    </a>
                </li>
            @endauth
            <li>
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
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">

            <a href="{{ route("login") }}" class="text-dark"><i class="fa fa-user"></i> Đăng nhập</a>

        </div>
        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Đăng ký</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li><a href="{{ route("home") }}">Trang chủ</a></li>
            <li><a href="{{ route("products") }}">Sản phẩm</a></li>
            <li><a href="{{ route("blogs") }}">Bài viết</a></li>
            <li><a href="{{ route("contact") }}">Liên hệ</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        @foreach ($social_media as $key => $social)
            <a href="{{ $social }}"><i class="fa fa-{{ $key }}"></i></a>
        @endforeach
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li>
                <i class="fa fa-envelope"></i>
                    <span>{{ $company["email"] }}</span>
                </li>
            <li>
                <a href="" class="text-dark">
                    Tra cứu đơn hàng
                </a>
            </li>
        </ul>
    </div>
</div>