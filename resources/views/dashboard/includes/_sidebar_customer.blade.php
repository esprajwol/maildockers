<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('dashboard/assets/images/admin.png') }}" alt="profile">
                    <span class="availability-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ user()->username }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customer.dashboard') }}">
                <span class="menu-title">{{localize('Customer Dashboard')}}</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
{{--            <a class="nav-link" href="{{ route('customer.notifications.index') }}">--}}
{{--                <span class="menu-title">{{ localize("Notifications") }}</span>--}}
{{--                <i class="mdi mdi-bell-alert-outline menu-icon"></i>--}}
{{--            </a>--}}
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#store" aria-expanded="false" aria-controls="store">
                <span class="menu-title">{{localize('Messages') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="store">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.orders') }}">{{ localize('Orders') }}</a></li>
                </ul>
            </div>
{{--            <div class="collapse" id="store">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.orderMessages') }}">{{ localize('Orders') }}</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </li>


    </ul>
</nav>
