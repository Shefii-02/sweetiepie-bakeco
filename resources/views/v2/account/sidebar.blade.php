<div class="card border-0 shadow-none">
    <div class="card-body">
        <div class="fw-semibold fs-5 text-overflow">
            Hi, {{ $user->firstname }} {{ $user->lastname }}
            <hr>
        </div>
        <div>
            <nav class="nav nav-pills nav-fill">
                <a class="@if(request()->is('account/profile')) fw-semibold @endif nav-link w-100 d-block text-dark text-decoration-none text-start hover-light mb-2" aria-current="page" href="{{ url('account/profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
                <a class="nav-link @if(request()->is('account/orders*')) fw-semibold @endif w-100 d-block text-dark text-decoration-none text-start hover-light  mb-2" aria-current="page" href="{{ url('/account/orders') }}"><i class="bi bi-receipt"></i> My orders</a>
                <a class="@if(request()->is('account/address*')) fw-semibold @endif nav-link w-100 d-block text-dark text-decoration-none text-start hover-light  mb-2" aria-current="page" href="{{ url('account/address') }}"><i class="bi bi-truck"></i> My address</a>
                <a class="@if(request()->is('account/password')) fw-semibold @endif nav-link w-100 d-block text-dark text-decoration-none text-start hover-light  mb-2" aria-current="page" href="{{ url('account/password') }}"><i class="bi bi-shield-exclamation"></i> Change password</a>
                <!--<a class="nav-link w-100 d-block text-dark text-decoration-none text-start hover-light  mb-2" aria-current="page" href="{{ url('contact') }}"><i class="bi bi-headset"></i> Contact us</a>-->
                <a class="nav-link w-100 d-block text-dark text-decoration-none text-start hover-light  mb-2" aria-current="page" href="{{ url('signout') }}"><i class="bi bi-power"></i> Logout</a>
              </nav>
        </div>
    </div>
</div>