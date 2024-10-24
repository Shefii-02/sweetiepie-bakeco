<div class="topbar topItems rightItem">
    <div class="bar-inside position-relative">
        <div class="top-main">
            <div class="checkout-btn shadow-none align-items-center d-none d-sm-flex">
                <div class="cart-btn shadow-none mr-auto d-flex align-items-center"><i
                        class="fa-solid fa-cart-shopping position-relative"><span class="cart-count2"><span class="m-auto fw-semibold">{{getCartCount()}}</span></span></i> <span class="cart-total ml-2">{{ getPrice(0) }}<span></div>
                <a href="{{ url("/cart") }}" class="btn shadow-none ms-auto ml-auto checkout-button">Cart</a>
            </div>
            <div class="previous-orders d-flex w-100 p-2 aligin-items-center position-relative">
                <div class="d-lg-none d-block"><span class="side-toggler"><i class="fa-solid fa-bars"></i></span></div>
                <div class="m-auto text-center">
                    <div class="h6 mb-0">Your cart</div><div style="height: 16px"><i  class="fa-solid fa-grip-lines"></i></div>
                </div>
                <div class="cart-toggle cursor-pointer text-dark d-sm-none">
                    <i class="fa-solid fa-angle-down m-auto"></i>
                </div>
            </div>
        </div>
        <div class="cart-items px-2 pt-2" style="display:none">
            
        </div>
    </div>
</div>