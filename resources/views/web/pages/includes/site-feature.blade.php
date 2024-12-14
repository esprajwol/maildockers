<section class="features-section">
    <div class="container">
        <div class="row justify-content-between align-content-stretch row-cols-1 row-cols-md-2">
            <div class="col features-items pl-0">
                <div class="section-card shadow">
                    <h3 class="title">{{ localize('feature_list') }}</h3>
                    <ul class="dot-ul-ui">
                        <li class="highlight"><i
                                class="fa-sharp fa-solid fa-square"></i><span>{{ localize('support_languages') }}</span></li>
                        <li class="highlight"><i
                                class="fa-sharp fa-solid fa-square"></i><span>{{ localize('support_google_suite') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('quick_generation') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('keyword_highlighting') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('export_options') }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('web.page', ['slug' => 'features']) }}"
                       class="anchor-link">{{ localize('more') }}</a>
                </div>
            </div>
            <div class="col features-items pr-0">
                <div class="section-card shadow">
                    <h3 class="title">{{ localize('feature_list') }}</h3>
                    <ul class="dot-ul-ui">
                        <li class="highlight"><i
                                class="fa-sharp fa-solid fa-square"></i><span>{{ localize('google_security_approval') }}</span></li>
                        <li class="highlight"><i
                                class="fa-sharp fa-solid fa-square"></i><span>{{ localize('gdpr_statement') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('no_document_storage') }}</span>
                        </li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('no_user_info_storage') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('content_privacy') }}</span></li>
                        <li><i class="fa-sharp fa-solid fa-square"></i><span>{{ localize('user_document_view') }}</span></li>
                    </ul>
                    <a href="{{ route('web.page', ['slug' => 'features']) }}"
                       class="anchor-link">{{ localize('more') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
