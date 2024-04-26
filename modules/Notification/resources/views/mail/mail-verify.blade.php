<div style="width: 500px; margin: 0 auto; color: black">
    <img width="100px" src="https://tvt.id.vn/assets/img/logo_login.jpg" alt="">
    <hr>
    <p>Xin chào {{ $name }}!</p>
    <p>Chúng tôi nhận được yêu cầu khôi phục mật khẩu của bạn.</p>
    <p>Mã đặt lại mật khẩu của bạn là: </p>
    <input 
        style="width: 100px; text-align: center; height: 40px; font-size: 18px; border: 1px solid aliceblue; background-color: rgb(216, 216, 216);" 
        type="text" 
        value="{{ $otp }}" 
        readonly>
    <p>Ngoài ra bạn cũng có thể trực tiếp thay đồi mật khẩu của mình.</p>
    <button 
        style="width: 150px; height: 40px; background-color: #f36957; color: white; font-size: 18px; border: none; border-radius: 5px;"
        >
        <a href="{{ $url }}" style="text-decoration: none; color: white;">
            Đổi mật khẩu
        </a>
    </button>
    <p>Mã xác thực chỉ tồn tại trong vòng 15 phút</p>
    <br>
    <h4>Bạn không yêu cầu thay đổi này?</h4>
    <p>Nếu bạn không yêu cầu thay đổi mật khẩu hãy bỏ qua</p>
    <hr>
    Tin nhắn này được gửi từ Tiệm bánh kem hương vị việt
</div>