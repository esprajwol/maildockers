<style>

</style>

<!-- Top Header Section -->
<div class="top-section">
    <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="heading">{{ localize('email_organization') }}</h1>
        </div></div>

    </div>
</div>
<header class="header-section">
    <div class="container">
        <div class="row d-block d-md-none">
            <nav class="navbar navbar-expand-lg mt-1 mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand img-container-sm pt-0" href="{{ url('/') }}">
                        <img src="{{ asset('./web/assets/img/resize-image/android-chrome-192x192.png') }}" alt="Logo"
                            class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">{{ localize('home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.page', ['slug' => 'features']) }}">{{ localize('features') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.page', ['slug' => 'our-privacy-policy']) }}">{{ localize('privacy_policy') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.page', ['slug' => 'terms-of-service']) }}">{{ localize('terms_service') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#articles">{{ localize('articles') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">{{ localize('contact') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#video">{{ localize('video') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row align-items-center">
            <div class="col-sm-3 col-md-2 d-none d-md-block">
                <a href="{{ url('/') }}" class="img-container block">
                    <img src="{{ asset('./web/assets/img/resize-image/android-chrome-192x192.png') }}" alt="site-logo">
                </a>
            </div>
            <div class="col-sm-9 col-md-10">
                <p class="paragraph">{{ localize('app_description') }}</p>
                <h3 class="title">{{ localize('email_organization') }}</h3>
                <ul class="dot-ul-ui">
                    <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('google_approval') }}</span></li>
                    <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('gdpr_compliance') }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</header>
