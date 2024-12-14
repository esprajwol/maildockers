<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="@if($user->user_type == 'admin'){{route('admin.dashboard')}} @elseif($user->user_type == 'partner') {{route('partner.dashboard')}} @elseif($user->user_type == 'distributor') {{route('distributor.dashboard')}}@endif">
            <img style="height: 60px;width: 60px" src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img
                src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">

                <?php $user = user();?>

                {{-- <a class="nav-link dropdown-toggle" id="profileDropdown" href="@if($user->user_type == 'admin') {{route('admin.user.admin.profile')}} @elseif($user->user_type == 'partner') {{route('partner.user.partner.profile')}} @elseif($user->user_type == 'distributor') {{route('distributor.user.distributor.profile')}}@endif" aria-expanded="false"> --}}
                <a class="nav-link dropdown-toggle" id="profileDropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="{{ asset('dashboard/assets/images/admin.png') }}" alt="image">
                        <span class="availability-status online"></span>
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{$user->username}}</p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="@if($user->user_type == 'admin') {{route('admin.user.admin.profile')}} @elseif($user->user_type == 'partner') {{route('partner.user.partner.profile')}} @elseif($user->user_type == 'distributor') {{route('distributor.user.distributor.profile')}} @endif">
                        <i class="mdi mdi-cached me-2 text-success"></i> My Profile </a>
                    <div class="dropdown-divider"></div>

                    @php
                        if(isAdmin()){
                            $passwordResetRoute = 'admin.userPasswordReset';
                        }elseif(isPartner()){
                            $passwordResetRoute = 'partner.userPasswordReset';
                        }elseif(isDistributor()){
                            $passwordResetRoute = 'distributor.userPasswordReset';
                        } elseif(isCustomer()){
                            $passwordResetRoute = 'customer.userPasswordReset';
                        }

                        $settingRoute = route("admin.user-settings.create");

                        if(isPartner()){
                            $settingRoute = route('partner.user-settings.create');
                        }

                        if(isDistributor()){
                            $settingRoute = route('distributor.user-settings.create');
                        }
                    @endphp

                    <a class="dropdown-item"
                       href="{{ route($passwordResetRoute) }}">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Change Password </a>
{{--                    <a class="dropdown-item"--}}
{{--                       href="{{ $settingRoute }}">--}}
{{--                        <i class="mdi mdi-settings me-2 text-primary"></i>--}}
{{--                        {{ localize("Settings") }}--}}
{{--                    </a>--}}
                </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="{{ route('admin.signout') }}" title="Log Out">
                    <i class="mdi mdi-power text-danger"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
                <a class="nav-link">
                    <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var profileDropdown = document.getElementById("profileDropdown");
        var dropdownMenu = document.querySelector(".dropdown-menu[aria-labelledby='profileDropdown']");

        profileDropdown.addEventListener("click", function(event) {
            event.preventDefault();

            var isExpanded = profileDropdown.getAttribute("aria-expanded") === "true";
            profileDropdown.setAttribute("aria-expanded", !isExpanded);
            dropdownMenu.classList.toggle("show", !isExpanded); // Bootstrap uses 'show' class to display dropdowns
        });

        document.addEventListener("click", function(event) {
            if (!profileDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
                profileDropdown.setAttribute("aria-expanded", "false");
                dropdownMenu.classList.remove("show");
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link[data-bs-toggle="collapse"]');

        navLinks.forEach(function(navLink) {
            navLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior

                var target = document.querySelector(navLink.getAttribute('href'));
                var isExpanded = navLink.getAttribute('aria-expanded') === 'true';

                // Toggle the aria-expanded attribute
                navLink.setAttribute('aria-expanded', !isExpanded);

                // Collapse or expand the target element
                if (isExpanded) {
                    target.classList.remove('show');
                } else {
                    target.classList.add('show');
                }

                // Close other open menus
                navLinks.forEach(function(otherNavLink) {
                    if (otherNavLink !== navLink) {
                        var otherTarget = document.querySelector(otherNavLink.getAttribute('href'));
                        otherNavLink.setAttribute('aria-expanded', 'false');
                        otherTarget.classList.remove('show');
                    }
                });
            });
        });
    });
    </script>

@endsection
