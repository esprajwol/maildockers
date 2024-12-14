<li class="slide">
    <a href="{{ route('partner.dashboard') }}" class="side-menu__item">
        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" opacity="0.2"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
        <span class="side-menu__label">{{ localize('dashboards') }}</span>
    </a>
</li>
<!-- Start::slide -->
<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <i class="bi bi-people"></i> &nbsp;
        <span class="side-menu__label">{{ localize('profile') }}</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">{{ localize('profile') }}</a>
        </li>
        <li class="slide">
            <a href="#" class="side-menu__item">{{ localize('partner_details') }}</a>
        </li>
        <li class="slide">
            <a href="#" class="side-menu__item">{{ localize('bank_details') }}</a>
        </li>

    </ul>
</li>
<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <i class="bi bi-globe"></i> &nbsp;
        <span class="side-menu__label">{{ localize('website_design') }}</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">{{ localize('website_design') }}</a>
        </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('logo') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('title') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('language') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('description') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('articles') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('q_and_a') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('links') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('videos') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('contact_details') }}</a> </li>
    </ul>
</li>

<li class="slide">
    <a href="#" class="side-menu__item">
        <i class="bi bi-currency-dollar"></i> &nbsp;
        <span class="side-menu__label">{{ localize('payments') }}</span>
    </a>
</li>

<li class="slide has-sub">
    <a href="javascript:void(0);" class="side-menu__item">
        <i class="bi bi-globe"></i> &nbsp;
        <span class="side-menu__label">{{ localize('traffic') }}</span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1 pages-ul">
        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">{{ localize('traffic') }}</a>
        </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('total_visits') }}</a> </li>
        <li class="slide"> <a href="#" class="side-menu__item">{{ localize('unique_visits') }}</a> </li>
    </ul>
</li>
<li class="slide">
    <a href="{{ route('partner.order_refund_requests') }}" class="side-menu__item">
        <i class="ri ri-refund-2-line"></i> &nbsp;
        <span class="side-menu__label">{{ localize('refund_requests') }}</span>
    </a>
</li>
<li class="slide">
<a href="{{ route('partner.prices.edit') }}" class="side-menu__item">
    <i class="ri-money-pound-circle-line"></i> &nbsp;
        <span class="side-menu__label">{{ localize('partner_price_setting') }}</span>
    </a>
</li>

