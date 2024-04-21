<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route("home") }}"><img src="{{ asset("assets/img/logo.png") }}" alt=""></a>
                    </div>
                    <ul>
                        <li>Địa chỉ: 60-49 Road 11378 New York</li>
                        <li>Số điện thoại: +65 11.188.888</li>
                        <li>Email: hello@colorlib.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-3">
                <div class="footer__widget">
                    <h6>Chính sách</h6>
                    <ul>
                        <li><a href="#">Điều khoản & điều kiện</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Chính sách trả hàng</a></li>
                        <li><a href="#">Chính sách hoàn tiền </a></li>
                        <li><a href="#">Chính sách hủy</a></li>
                    </ul>
                    <ul>
                        <li><a href="{{ route("products") }}">Sản phẩm</a></li>
                        <li><a href="{{ route("blogs") }}">Bài viết</a></li>
                        <li><a href="{{ route("contact") }}">Liên hệ</a></li>
                        <li><a href="{{ route("about_us")}}">Về chúng tôi</a></li>
                        <li><a href="#">Sơ đồ Website</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Đăng ký để nhận thông báo</h6>
                    <p>Nhận tin tức về những sản phẩm mới và ưu đãi</p>
                    <form action="#">
                        <input type="text" placeholder="Nhập email">
                        <button type="submit" class="site-btn">Đăng ký</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                        </p>
                    </div>
                    <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="back-to-top text-center show" title="Lên đầu trang">
        <i class="fa fa-angle-up"></i>
    </div>
</footer>

<div id="button__contact" >
	<div class="button__contact" >
		<div class=""  id="message">
			<div class="button__circle__fill"></div>
			<div class="button__circle__img">
				<a target="_blank" href="https://m.me/283633054835585">			
					<img src="{{ asset("assets/img/messenger.png") }}" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="button__contact" >
		<div class="" id="zalo">
			<div class="button__circle__fill"></div>
			<div class="button__circle__img" >
				<a target="_blank" class="text-dark" href="https://zalo.me/0919677164">
					<img src="{{ asset("assets/img/zalo.png") }}" alt="">
				</a>
			</div>
		</div>
	</div>
	<div  class="button__contact" >
		<div class="" id="phone">
			<div class="button__circle__fill" ></div>
			<div class="button__circle__img">
				<a href="tel:0919677164">				
					<img src="{{ asset("assets/img/phone.png") }}" alt="Phone">
				</a>
			</div>
		</div>
	</div>
</div>
