@extends('web.layout')
@section('title', ucfirst($metaTitle))
@push('extra-styles')
<link href="{{ asset('./web/assets/css/pages/terms.css') }}" rel="stylesheet">
@endpush
@section('content')
<section class="features-section">
    <div class="container">
        <div class="row">
            <div class="section-card">
                <h1 class="heading mb-4">{{ ucfirst($metaTitle) }}</h1>


                <p class="paragraph extra" style="text-decoration: underline;">@lang('lang.txt86')</p>
                <p class="paragraph extra"><b>{{ localize('terms_summary') }}</b></p>
                <p class="paragraph extra">{{ localize('our_site') }} <a
                        href="https://legalpdf.co/">https://legalpdf.co/</a> (<b>{{ localize('our_site') }}</b>).</p>
                <p class="paragraph extra">{{ localize('info_links') }}</p>
                <ul class="dot-ul-ui extra">
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#whoWeAre">{{ localize('contact_us') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#acceptTerms">{{ localize('site_usage_confirmation') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#otherTerms">{{ localize('applicable_terms') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#changeTerms">{{ localize('terms_changes') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#changeSite">{{ localize('site_changes') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#suspendSite">{{ localize('site_suspension') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#siteForUk">{{ localize('uk_only') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#accountDetails">{{ localize('account_safety') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#useMaterial">{{ localize('site_material_usage') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#dontRely">{{ localize('disclaimer') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#linkedWebsites">{{ localize('third_party_links') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#userContent">{{ localize('user_content_policy') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#damageResponsible">{{ localize('liability_summary') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#uploadingContent">{{ localize('upload_rules') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#uploadRights">@lang('lang.txt105')</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#viruses">{{ localize('virus_protection') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#linkingRules">{{ localize('linking_rules') }}</a></li>
                    <li aria-level="1" style="font-size: 1.7rem;"><a href="#disputesCountry">{{ localize('dispute_resolution') }}</a></li>

                </ul>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="whoWeAre">{{ localize('contact_us') }}</b></p>
                <p class="paragraph extra"><a href="https://legalpdf.co/">https://legalpdf.co/</a> {{ localize('company_operator_info') }}<b>LegalPDF Limited</b>
                    {{ localize('company_registration') }}&nbsp;18 Elington Road, London E8 3PA</p>
                <p class="paragraph extra">{{ localize('contact_email') }} <a href="mailto:legalpdf.mail@gmail.com">legalpdf.mail@gmail.com</a></p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="acceptTerms">{{ localize('site_usage_confirmation') }}</b></p>
                <p class="paragraph extra">{{ localize('site_terms_acceptance') }}</p>
                <p class="paragraph extra">{{ localize('terms_disagreement') }}</p>
                <p class="paragraph extra">{{ localize('print_terms_recommendation') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="otherTerms">{{ localize('applicable_terms') }}</b></p>
                <p class="paragraph extra">{{ localize('additional_terms') }}</p>
                <ul class="dot-ul-ui extra">
                    <li aria-level="1" class="fontsize-1-7">Our&nbsp;<a
                            href="{{ route('web.page', ['slug' => 'our-privacy-policy']) }}">
                            Privacy Policy</a></li>
                    <li aria-level="1" class="fontsize-1-7">Our&nbsp;<a
                            href="{{ route('web.page', ['slug' => 'terms-of-service']) }}">
                            {{ localize('additional_terms') }}</a>{{ localize('cookie_policy_description') }}</li>
                </ul>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="changeTerms">{{ localize('terms_changes') }}</b></p>
                <p class="paragraph extra">{{ localize('terms_revision') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="changeSite">{{ localize('site_changes') }}</b></p>
                <p class="paragraph extra">@lang('lang.txt120')</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="suspendSite">{{ localize('site_suspension') }}</b></p>
                <p class="paragraph extra">{{ localize('site_availability') }}</p>
                <p class="paragraph extra">{{ localize('user_access_responsibility') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="useMaterial">{{ localize('site_material_usage') }}</b></p>
                <p class="paragraph extra">{{ localize('intellectual_property_notice') }}</p>
                <p class="paragraph extra">{{ localize('personal_use_print_download') }}</p>
                <p class="paragraph extra">{{ localize('no_modification_of_materials') }}</p>
                <p class="paragraph extra">{{ localize('author_credit_required') }}</p>
                <p class="paragraph extra">{{ localize('no_commercial_use_without_license') }}</p>
                <p class="paragraph extra">{{ localize('breach_consequence_action') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="dontRely">{{ localize('disclaimer') }}</b></p>
                <p class="paragraph extra">{{ localize('general_information_disclaimer') }}</p>
                <p class="paragraph extra">{{ localize('content_accuracy_disclaimer') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="linkedWebsites">{{ localize('third_party_links') }}</b>
                </p>
                <p class="paragraph extra">{{ localize('third_party_links_info_only') }}</p>
                <p class="paragraph extra">{{ localize('no_control_over_third_party_content') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="damageResponsible">{{ localize('liability_summary') }}</b></p>
                <p class="paragraph extra"><b>{{ localize('consumer_business_liability_disclaimer') }}</b></p>
                <ul class="dot-ul-ui extra">
                    <li aria-level="1" class="fontsize-1-7">We do not exclude or limit in any way our liability
                        to you where it would be unlawful to do so. This includes liability for death or personal injury
                        caused by our negligence or the negligence of our employees, agents or subcontractors and for
                        fraud or fraudulent misrepresentation.</li>
                    <li aria-level="1" class="fontsize-1-7">Different limitations and exclusions of liability
                        will apply to liability arising as a result of the supply of any products to you, which will be
                        set out in our Terms and conditions of supply.</li>
                </ul>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b>{{ localize('business_user_liability_exclusion') }}</b></p>
                <ul class="dot-ul-ui extra">
                    <li aria-level="1" class="fontsize-1-7">We exclude all implied conditions, warranties,
                        representations or other terms that may apply to our site or any content on it.</li>
                    <li aria-level="1" class="fontsize-1-7">We will not be liable to you for any loss or damage,
                        whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even
                        if foreseeable, arising under or in connection with:</li>
                    <li aria-level="1" class="fontsize-1-7">use of, or inability to use, our site; or</li>
                    <li aria-level="1" class="fontsize-1-7">use of or reliance on any content displayed on our
                        site.</li>
                    <li aria-level="1" class="fontsize-1-7">In particular, we will not be liable for:</li>
                    <li aria-level="1" class="fontsize-1-7">loss of profits, sales, business, or revenue;</li>
                    <li aria-level="1" class="fontsize-1-7">business interruption;</li>
                    <li aria-level="1" class="fontsize-1-7">loss of anticipated savings;</li>
                    <li aria-level="1" class="fontsize-1-7">loss of business opportunity, goodwill or
                        reputation; or</li>
                    <li aria-level="1" class="fontsize-1-7">any indirect or consequential loss or damage.</li>
                </ul>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b>{{ localize('consumer_user_disclaimer') }}</b></p>
                <ul class="dot-ul-ui extra">
                    <li aria-level="1" class="fontsize-1-7">Please note that we only provide our site for
                        domestic and private use. You agree not to use our site for any commercial or business purposes,
                        and we have no liability to you for any loss of profit, loss of business, business interruption,
                        or loss of business opportunity.</li>
                </ul>
                <p class="paragraph extra">{{ localize('defective_content_liability') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b>{{ localize('personal_info_use') }}</b></p>
                <p class="paragraph extra">{{ localize('personal_info_usage_terms') }} <a
                        href="{{ route('web.page', ['slug' => 'our-privacy-policy']) }}">privacy
                        policy</a>.</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="viruses">{{ localize('virus_protection') }}</b></p>
                <p class="paragraph extra">{{ localize('no_site_security_guarantee') }}</p>
                <p class="paragraph extra">{{ localize('user_responsibility_for_security') }}</p>
                <p class="paragraph extra">{{ localize('no_misuse_of_site') }}</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="linkingRules">{{ localize('linking_rules') }}</b></p>
                <p class="paragraph extra">{{ localize('home_page_link_permission') }}</p>
                <p class="paragraph extra">{{ localize('no_unauthorized_association') }}</p>
                <p class="paragraph extra">{{ localize('no_linking_from_non_owned_sites') }}</p>
                <p class="paragraph extra">{{ localize('no_site_framing') }}</p>
                <p class="paragraph extra">{{ localize('right_to_withdraw_linking_permission') }}</p>
                <p class="paragraph extra">{{ localize('contact_for_content_use') }}<a href="mailto:legalpdf.mail@gmail.com">legalpdf.mail@gmail.com</a>.</p>
                <p class="paragraph extra">&nbsp;</p>
                <p class="paragraph extra"><b id="disputesCountry">{{ localize('dispute_resolution') }}</b></p>
                <p class="paragraph extra">{{ localize('jurisdiction_and_governing_law') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
