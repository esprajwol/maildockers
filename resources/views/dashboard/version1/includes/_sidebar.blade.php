
<li class="slide">
    <a href="{{ route('admin.dashboard') }}" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" opacity="0.2"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
        <span class="side-menu__label">Dashboards</span>
    </a>
</li>
<!-- End::slide -->

<!-- Start::slide -->
<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
        <span class="side-menu__label">Partner's</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">Pages</a>
        </li>
        <li class="slide">
            <a href="{{ route('admin.partners.index') }}" class="side-menu__item">All Partners</a>
        </li>
        @if (isAdmin())
            <li class="slide">
                <a href="{{ route('admin.partners.create') }}" class="side-menu__item">Add New Partners</a>
            </li>
        @endif

    </ul>
</li>

<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
        <span class="side-menu__label">Coupons</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide">
            <a href="{{ route('admin.coupons.index') }}" class="side-menu__item">Coupon List</a>
        </li>
        <!-- <li class="slide">
            <a href="{{ route('admin.coupons.used') }}" class="side-menu__item">Used Coupons</a>
        </li> -->
    </ul>
</li>

@if (isAdmin())
<!-- Start::slide -->
<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
        <span class="side-menu__label">Multiple Language</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">Pages</a>
        </li>
        <li class="slide">
            <a href="{{ route('admin.languages.index') }}" class="side-menu__item">All Languages</a>
        </li>
        
        <li class="slide">
            <a href="{{ route('admin.localizations.index') }}" class="side-menu__item">All Localizations</a>
        </li>
    </ul>
</li>
@endif
<!--<li class="slide">
    <a href="route('admin.languages.index') }}" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256">
            <rect width="256" height="256" fill="none"/>
            <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
            <line x1="37.5" y1="96" x2="218.5" y2="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
            <line x1="37.5" y1="160" x2="218.5" y2="160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
            <path d="M128,32A96,96,0,0,1,96.8,224A96,96,0,0,1,159.2,224A96,96,0,0,1,128,32Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/>
          </svg>

        <span class="side-menu__label">Languages</span>
    </a>
</li>-->
<!-- End::slide -->
