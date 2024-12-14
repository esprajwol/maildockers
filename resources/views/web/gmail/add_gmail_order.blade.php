<h1 class="heading">{{ localize('email_to_pdf') }}</h1>
<p class="form-paragraph">{{ localize('address_prompt') }}</p>
<form action="{{ route('web.generate') }}" method="POST">

    @csrf
    @include("web.gmail.form_gmail")

    <div class="form-group">
        @if(isLaravelGmailLoggedIn())
            <button class="form-btn"
                    id="btn-generate"
                    type="submit">
                {{ localize('generate_pdf') }}
            </button>
        @else
            <button class="no-border"
                    id="btn-generate"
                    type="submit">
                <img src="{{ asset('web/assets/img/btn_google_signin_light_normal_web.png') }}"
                     alt="login-btn"
                     loading="lazy"
                     border="0" />
            </button>
        @endif
    </div>
</form>
