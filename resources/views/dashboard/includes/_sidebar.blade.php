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
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="{{ route('admin.orders') }}">--}}
{{--                <span class="menu-title">Order</span>--}}
{{--                <i class="mdi mdi-email menu-icon"></i>--}}
{{--            </a>--}}
{{--        </li>--}}

{{--        --}}{{-- Partner Start --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#partner" aria-expanded="false" aria-controls="brand">
                <span class="menu-title">Partners</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="partner">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.partners.index') }}">All Partners</a></li>
                    @if (isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.partners.create') }}">
                                Add New Partner
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

{{--        --}}{{-- Distributors Start --}}



{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">--}}
{{--                <span class="menu-title">Users</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="user">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">All Users</a></li>--}}
{{--                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.create') }}">Add New--}}
{{--                                User</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-bs-toggle="collapse" href="#package" aria-expanded="false" aria-controls="package">--}}
{{--                <span class="menu-title">Packages</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="package">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.package.lists') }}">Show Lists</a></li>--}}
{{--                    @if (isAdmin())--}}
{{--                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.package.generate') }}">Add New--}}
{{--                        Package</a></li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}



      {{--  <li class="nav-item sidebar-actions">
            <span class="nav-link">
                <div class="border-bottom">
                    <h6 class="font-weight-normal mb-3">Lottery Generate</h6>
                </div>
            </span>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#lottery" aria-expanded="false" aria-controls="lottery">
                <span class="menu-title">Lotteries</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="lottery">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.lottery.lists') }}">Show Lists</a>
                    </li>
                    @if (isDistributor())
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.lottery.create') }}">Create New
                                Lottery</a></li>
                    @endif
                </ul>
            </div>
        </li> --}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-bs-toggle="collapse" href="#cms" aria-expanded="false" aria-controls="cms">--}}
{{--                <span class="menu-title">CMS</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="cms">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.package.lists') }}">{{ localize('Packages') }}</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
    </ul>
</nav>
