<footer class="bottom-section mb-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <hr />
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 footer-nav-area">
            <div class="col">
                <div class="row align-items-center flex-column">
                    <div class="col">
                        <a href="{{ url('/') }}" class="footer-img block">
                            <img src="{{ asset('./web/assets/img/resize-image/android-chrome-192x192.png') }}"
                                alt="site-logo">
                        </a>
                    </div>
                    <div class="col">
                        <ul class="dot-ul-ui">
                            <li><a href="https://www.facebook.com/CORRbuilder-113474187493980" target="_blank"><i
                                        class="fa-brands fa-square-facebook facebook-blue"></i></a></li>
                            <li><a href="https://www.instagram.com/LegalPDF/" target="_blank"><i
                                        class="fa-brands fa-square-instagram instagram-black"></i></a></li>
                            <li><a href="https://twitter.com/LegalPDF" target="_blank"><i
                                        class="fa-brands fa-square-twitter twitter-blue"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/corrbuilder/" target="_blank"><i
                                        class="fa-brands fa-linkedin linkedin-blue"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col footer-responsive" id="contact">
                <h3 class="footer-title"><span>{{ localize('london') }}</span> OFFICE</h3>
                <ul class="footer-links">
                    <li><i class="fa-solid fa-phone"></i><a href="tel:+44 208 5053 311">+44 208 5053 311</a></li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:+44 770 3647 933">+44 770 3647 933</a></li>
                    <li><i class="fa-solid fa-location-dot"></i><a
                            href="https://www.google.com/maps/search/18+Elington+Road,+London+E8+3PA/@51.5414638,-0.0579563,18z/data=!3m1!4b1"
                            target="_blank">{{ localize('address_london') }}</a></li>
                </ul>
            </div>
            {{-- <div class="col footer-responsive">
                <h3 class="footer-title"><span>{{ localize('jerusalem') }}</span> OFFICE</h3>
                <ul class="footer-links">
                    <li><i class="fa-solid fa-phone"></i><a href="tel:+972 2641 11 55">+972 2641 11 55</a></li>
                    <li><i class="fa-solid fa-phone"></i><a href="tel:+972 5384 88 60">+972 5384 88 60</a></li>
                    <li><i class="fa-solid fa-location-dot"></i><a
                            href="https://www.google.com/maps/place/City+Home+Tel+Aviv+-+Yehoshua+Bin+Nun/@32.0878252,34.7804299,19.54z/data=!4m6!3m5!1s0x151d4bec5e29811f:0xde99f25ce5db744!8m2!3d32.087982!4d34.7803032!16s%2Fg%2F11h12b9zbv"
                            target="_blank">{{ localize('address_london') }}</a></li>
                </ul>
            </div> --}}
            <div class="col">
                <div class="img-holder">
                    <img src="{{ asset('./web/assets/img/worldmap.png') }}" alt="world-map">
                </div>
            </div>
        </div>
        <div class="row justify-content-end language-area">
            <div class="col-auto">
                <div class="language-dropdown-wrapper">
                    <select onchange="language(this.value, this.options[this.selectedIndex].getAttribute('lang-direction') );" class="form-select language-dropdown">
                        @foreach(getCountries() as $country)
                            <option value="{{ $country->code }}" lang-direction="{{ $country->direction }}" 
                                {{ getSession('lang') === $country->code ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 copyright-area mt-3">
            <div class="col">
                <p class="copyright">{{ localize('copyright_notice') }} <span>{{ localize('company_name') }}</span></p>
            </div>
            <div class="col">
                <ul class="extra-links">
                    <li><a href="{{ route('web.page', ['slug' => 'our-privacy-policy']) }}">{{ localize('privacy_policy') }}</a></li>
                    <li><a href="{{ route('web.page', ['slug' => 'terms-of-service']) }}">{{ localize('terms_of_service') }}</a></li>
                    <li><a href="{{ route('web.page', ['slug' => 'google-api-services']) }}">{{ localize('google_api_services') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@push('extra-scripts')
<script src="{{ asset('web/assets/js/app.js?v='.time()) }}"></script>
@endpush
