@extends('client.layouts.app')

@section('content')
    
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán đơn hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="/">Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="" method="post">
                <h4>Thông tin đơn hàng</h4>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="checkout__input">
                            <p>Họ và Tên<span>*</span></p>
                            <input type="text" name="name"required>
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="number" name="phone" required>
                        </div>
                        <div class="checkout__input">
                            <p>Email<span>*</span></p>
                            <input type="text" name="email"required>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ nhận hàng<span>*</span></p>
                            <input type="text" name="address"required>
                        </div>
                        <div class="checkout__input">
                            <p>Ghi chú đặt hàng</p>
                            <input type="text" name="note">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">                            
                            <h3>Đơn hàng của bạn</h3>
                            <div class="checkout__order__subtotal">Tổng tiền sản phẩm 
                                <span>{{ Cart::subtotal() }} đ</span>
                            </div>
                            <div class="checkout__order__tax">Thuế VAT (10%) 
                                <span>{{ Cart::tax() }} đ</span>
                            </div>
                            <div class="checkout__order__ship">Phí vận chuyển <span>Miễn phí</span></div>
                            <div class="checkout__order__total">Tổng thanh toán 
                                <span>{{ Cart::total() }} đ</span>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="COD">
                                    COD
                                    <input type="checkbox" id="COD">
                                    <span class="checkmark"></span>
                                </label>
                            <div class="checkout__input__checkbox">
                                <label for="Momo">
                                    Ví điện tử Momo
                                    <input type="checkbox" id="Momo">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <button type="submit" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection
