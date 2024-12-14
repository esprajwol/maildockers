<section class="articles-section" id="articles">
    <div class="container">
        <div class="row mb-3 mt-3">
            <div class="col">
                <h3 class="title">{{ localize('latest_articles') }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="dot-ul-ui">
                    <li><a
                            href="{{ route('web.page', ['slug' => 'gmail-to-pdf-converter-online']) }}">{{ localize('converter_gmail_to_pdf') }}</a>
                    </li>
                    <li><a
                            href="{{ route('web.page', ['slug' => 'export-emails-from-gmail-to-pdf']) }}">{{ localize('export_emails_to_pdf') }}</a>
                    </li>
                    <li><a
                            href="{{ route('web.page', ['slug' => 'save-multiple-emails-as-pdf-gmail']) }}">{{ localize('save_multiple_emails') }}</a>
                    </li>
                    <li><a
                            href="{{ route('web.page', ['slug' => 'save-email-from-gmail-as-pdf']) }}">{{ localize('save_single_email') }}</a>
                    </li>
                    <li><a href="{{ route('web.page', ['slug' => 'save-a-gmail-as-pdf']) }}">@lang('lang.txt55')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
