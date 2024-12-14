<div class="row flex-column flex-md-row mb-3">
    <div class="col col-md-4">
        <input type="email" id="your_email"
               class="form-control @error('your_email') is-invalid text-danger @enderror" name="your_email"
               placeholder="{{ localize('user_google_email') }}"
               value="{{ isLaravelGmailLoggedIn() ?  laravelGmailUser() : old('your_email') }}" autocomplete="off"
               required />
        <small class="text-danger"></small>
    </div>
    <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">{{ localize('and') }}</p>
    <div class="col col-md-4">
        <input type="email" id="email_from"
               class="form-control @error('email_from') is-invalid text-danger @enderror" name="email_from"
               placeholder="{{ localize('colleague_email') }}" value="{{ old('email_form') }}" autocomplete="off"
               required />
        <small class="text-danger"></small>
    </div>
</div>


<p class="form-paragraph">{{ localize('google_support') }}</p>

<div class="collapse-tabs mt-5">
    <!-- Collapse Tabs 1 -->
    <p class="collapse-title mt-5 mb-3" data-bs-toggle="collapse" href="#collapseKeyWords" role="button"
       aria-expanded="false" aria-controls="collapseKeyWords">
        {{ localize('search_keywords') }}
    </p>
    <div class="collapse" id="collapseKeyWords">
        <div class="row flex-column">
            <div class="col col-md-4 mb-4">
                <label for="inc_keywords" class="form-labels">{{ localize('keyword_instruction') }}</label>
                <input type="text" class="form-control @error('inc_keywords') is-invalid text-danger @enderror"
                       id="inc_keywords" name="inc_keywords" placeholder="{{ localize('keyword_example') }}"
                       autocomplete="off">
                <small class="text-danger"></small>
            </div>
            <div class="col col-md-4 mb-4">
                <label for="exc_keywords" class="form-labels">{{ localize('exclude_keywords') }}</label>
                <input type="text" class="form-control @error('exc_keywords') is-invalid text-danger @enderror"
                       id="exc_keywords" name="exc_keywords" placeholder="{{ localize('keyword_example') }}"
                       autocomplete="off">
                <small class="text-danger"></small>
            </div>
        </div>
    </div>

    <!-- Collapse Tabs 2 -->
    <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseTimeFrame" role="button"
       aria-expanded="false" aria-controls="collapseTimeFrame">
        {{ localize('search_timeframe') }}
    </p>
    <div class="collapse" id="collapseTimeFrame">
        <div class="row mb-4">
            <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('starts') }}</p>
            <div class="col col-md-2">
                <input type="text"
                       class="form-control @error('start_date') is-invalid text-danger @enderror datepicker"
                       id="start_date" name="start_date" placeholder="yyyy-mm-dd" autocomplete="off">
                <small class="text-danger"></small>
            </div>
            <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('ends') }}</p>
            <div class="col col-md-2">
                <input type="text"
                       class="form-control @error('end_date') is-invalid text-danger @enderror datepicker"
                       id="end_date" name="end_date" placeholder="yyyy-mm-dd" autocomplete="off">
                <small class="text-danger"></small>
            </div>
        </div>
    </div>

<!-- Collapse Tabs 3 -->
    <p class="collapse-title mt-5" data-bs-toggle="collapse" href="#collapseLanguage" role="button"
       aria-expanded="false" aria-controls="collapseLanguage">
        {{ localize('document_language') }}
    </p>
    <div class="collapse" id="collapseLanguage">
        <div class="row mb-3">
            <div class="col col-md-2">
                <select class="form-select form-select-lg @error('language') is-invalid text-danger @enderror"
                        name="language" aria-label=".form-select-lg example">
                    <option selected value="{{ urlencode('en') }}">{{ localize('english') }}</option>
                    <option value="{{ urlencode('he') }}">{{ localize('hebrew') }}</option>
                </select>
                <small class="text-danger"></small>
            </div>
        </div>
    </div>


</div>
