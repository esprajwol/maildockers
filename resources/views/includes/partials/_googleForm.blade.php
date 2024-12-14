<h1 class="heading">{{ localize('email_to_pdf') }}</h1>
<p class="form-paragraph">{{ localize('address_prompt') }}</p>

@if ($generateAgain):
    <form data-action="{{ route('web.generate.again') }}" id="filter-form"
        data-login-state="{{ LaravelGmail::check() ? 1 : 0 }}" data-auth-url="{{ url('oauth/gmail') }}">
        @csrf
        @method('POST')
        <div class="row flex-column flex-md-row mb-3">
            <div class="col col-md-4">
                <input readonly type="email" id="your_email"
                    class="form-control @error('your_email') is-invalid text-danger @enderror" name="your_email"
                    placeholder="{{ localize('user_google_email') }}"
                    value="{{ old('your_email', $order->from_email ?? LaravelGmail::user()) }}" autocomplete="off"
                    required  />
                <small class="text-danger"></small>
            </div>
            <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">{{ localize('and') }}</p>
            <div class="col col-md-4">
                <input type="email" id="email_from"
                    class="form-control @error('email_from') is-invalid text-danger @enderror"
                    value="{{ old('email_from', $order->recipient_email ?? '') }}" name="email_from"
                    placeholder="{{ localize('colleague_email') }}" autocomplete="off" required />
                <small class="text-danger"></small>
            </div>
        </div>

        <p class="form-paragraph">{{ localize('google_support') }}</p>

        <div class="collapse-tabs mt-5">

            <!-- Collapse Tabs 1 -->
              <p class="collapse-title mt-5 mb-3" data-bs-toggle="collapse" href="#collapseKeyWords" role="button"
   aria-expanded="false" aria-controls="collapseKeyWords" id="toggleCollapses">
    <span id="toggleIcons"> {{ localize('search_keywords') }} +</span>
</p>
            <div class="collapse" id="collapseKeyWords">
                <div class="row flex-column">
                    <div class="col col-md-4 mb-4">
                        <label for="inc_keywords" class="form-labels">{{ localize('keyword_instruction') }}</label>
                        <input type="text"
                            class="form-control @error('inc_keywords') is-invalid text-danger @enderror"
                            id="inc_keywords" name="inc_keywords"
                            value="{{ old('inc_keywords', $order->keyword ?? '') }}" placeholder="{{ localize('keyword_example') }}"
                            autocomplete="off" />
                        <small class="text-danger"></small>
                    </div>

                    <div class="row mb-4">
                    <div class="col col-md-6">
                      <!-- Option for 0 value -->
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="1" 
                             id="search_keyword_list_1"
                             {{ (old('search_keyword_list', $order->search_keyword_list ?? 0) == 1) ? 'checked' : '' }}>
                      <label class="form-check-label" 
                             for="search_keyword_list_1" 
                             style="font-size:14px; margin-left: 5px;">
                             {{ localize('search_KeywordInclude') }}
                      </label>
                      <br>
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="0" 
                             id="search_keyword_list_0"
                             {{ (old('search_keyword_list', $order->search_keyword_list ?? 0) == 0) ? 'checked' : '' }}>
                      <label class="form-check-label" 
                             for="search_keyword_list_0" 
                             style="font-size:14px; margin-left: 5px;">
                             {{ localize('search_KeywordAtach') }}
                      </label>
                     
                    </div>
                </div>
                    <!-- <div class="col col-md-4 mb-4">
                        <label for="exc_keywords" class="form-labels">{{ localize('exclude_keywords') }}</label>
                        <input type="text"
                            class="form-control @error('exc_keywords') is-invalid text-danger @enderror"
                            id="exc_keywords" value="{{ old('exc_keywords', $order->exclude_keyword ?? '') }}"
                            name="exc_keywords" placeholder="{{ localize('keyword_example') }}" autocomplete="off">
                        <small class="text-danger"></small>
                    </div> -->
                </div>
            </div>

            <!-- Collapse Tabs 2 -->
              <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseTimeFrame" role="button"
                aria-expanded="false" aria-controls="collapseTimeFrame" id="timeCollapseFrame">
                <span id="toggleIconTimeFrame"> {{ localize('search_timeframe') }} +</span>
            </p>

            <div class="collapse" id="collapseTimeFrame">
                <div class="row mb-4">
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('starts') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                            class="form-control @error('start_date') is-invalid text-danger @enderror datepicker"
                            id="start_date" value="{{ old('start_date', $order->start_date ?? '') }}" name="start_date"
                            placeholder="yyyy-mm-dd" autocomplete="off">
                        <small class="text-danger"></small>
                    </div>
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('ends') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                            class="form-control @error('end_date') is-invalid text-danger @enderror datepicker"
                            id="end_date" value="{{ old('end_date', $order->end_date ?? '') }}" name="end_date"
                            placeholder="yyyy-mm-dd" autocomplete="off">
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 3 -->
             <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseAttachments" role="button"
                aria-expanded="false" aria-controls="collapseTimeAttach" id="searchAttachmentDoc">
                <span id="toggleIconAttachment"> {{ localize('search_attachments') }} +</span> 
            </p>

            <div class="collapse" id="collapseAttachments">
                <div class="row mb-4">
                    <div class="col col-md-6">
                    <input class="form-check-input mt-2" 
                             name="search_attachments_list" 
                             type="radio" 
                             value="2" 
                             id="search_attachments_list_2" 
                             {{ (old('search_attachments_list', $order->search_attachments_list ?? 0) == 2) ? 'checked' : '' }}>
                      <label class="form-check-label" 
                             for="search_attachments_list_2" 
                             style="font-size:16px; margin-left: 5px;">
                        I want all the correspondence plus the list of all attachments
                      </label>
                        <br>
                        <input name="search_attachments_list" type="hidden" value="0" id="search_attachments_list_0">
                        <input class="form-check-input mt-2" 
                            name="search_attachments_list" 
                            type="radio" 
                            value="1" 
                            id="search_attachments_list_1" 
                            {{ (old('search_attachments_list', $order->search_attachments_list ?? 0) == 1) ? 'checked' : '' }}
                            >
                        <label class="form-check-label" 
                            for="search_attachments_list_1" 
                            style="font-size:16px; margin-left: 5px;">
                        I want a list of all attachments only, no email correspondence
                      </label>
                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 4 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseLanguage" role="button"
                aria-expanded="false" aria-controls="collapseLanguage" id="searchDocument">
                <span id="toggleDocument"> {{ localize('document_language') }} +</span>
            </p>
            <div class="collapse" id="collapseLanguage">
                <div class="row mb-3">
                    <div class="col col-md-2">
                        <select class="form-select form-select-lg @error('language') is-invalid text-danger @enderror"
                            name="language" aria-label=".form-select-lg example">
                            <option value="{{ urlencode('en') }}"
                                {{ old('language', $order->language ?? '') == 'en' ? 'selected' : '' }}>
                                {{ localize('english') }}</option>
                            <option value="{{ urlencode('he') }}"
                                {{ old('language', $order->language ?? '') == 'he' ? 'selected' : '' }}>
                                {{ localize('hebrew') }}</option>
                        </select>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>


        </div>

        <div class="form-group">
            <button class="btnGenerate" id="btn-generate" type="submit">@lang('lang.txt169')</button>
        </div>
    </form>
@else
    <form data-action="{{ route('web.generate') }}" id="filter-form"
        data-login-state="{{ LaravelGmail::check() ? 1 : 0 }}" data-auth-url="{{ url('oauth/gmail') }}">
        @csrf
        @method('POST')
        <div class="row flex-column flex-md-row mb-3">
            <div class="col col-md-4">

                @if (session('userName'))
                    <input readonly type="email" id="your_email_readonly"
                        class="form-control @error('your_email') is-invalid text-danger @enderror" name="your_email"
                        placeholder="{{ localize('user_google_email') }}" value="{{ old('your_email', LaravelGmail::user()) }}"
                        autocomplete="off" required  />
                @else
                    <input type="email" id="your_email_without"
                        class="form-control @error('your_email') is-invalid text-danger @enderror" name="your_email"
                        placeholder="{{ localize('user_google_email') }}" value="{{ old('your_email', LaravelGmail::user()) }}"
                        autocomplete="off" required />
                @endif
                <small class="text-danger"></small>
            </div>
            <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">{{ localize('and') }}</p>
            <div class="col col-md-4">
                <input type="email" id="email_from"
                    class="form-control @error('email_from') is-invalid text-danger @enderror"
                    value="{{ old('email_from') }}" name="email_from" placeholder="{{ localize('colleague_email') }}"
                    autocomplete="off" required />
                <small class="text-danger"></small>
            </div>
        </div>

        <p class="form-paragraph">{{ localize('google_support') }}
        </p>

        <div class="collapse-tabs mt-5">
            <!-- Collapse Tabs 1 -->
          

            <div class="collapse-container">
    <!-- <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapseKeyWords" 
            aria-expanded="false" aria-controls="collapseKeyWords" id="toggleButton">
        <span id="toggleIcon">+</span>  {{ localize('search_keywords') }}
    </button> -->

    <p class="collapse-title mt-5 mb-3" data-bs-toggle="collapse" href="#collapseKeyWords" role="button"
   aria-expanded="false" aria-controls="collapseKeyWords" id="toggleCollapses">
    <span id="toggleIcons"> {{ localize('search_keywords') }} +</span>
</p>


            <div class="collapse" id="collapseKeyWords">
                <div class="row flex-column">
                    <div class="col col-md-4 mb-4">
                        <label for="inc_keywords" class="form-labels">{{ localize('keyword_instruction') }}</label>
                        <input type="text"
                            class="form-control @error('inc_keywords') is-invalid text-danger @enderror"
                            id="inc_keywords" name="inc_keywords" placeholder="{{ localize('keyword_example') }}"
                            autocomplete="off" />
                        <small class="text-danger"></small>
                    </div>

                    <div class="row mb-4">
                    <div class="col col-md-6">
                      <!-- Option for 0 value -->
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="1" 
                             id="search_keyword_list_1" checked>
                      <label class="form-check-label" 
                             for="search_keyword_list_1" 
                             style="font-size:14px; margin-left: 5px;">
                             {{ localize('search_KeywordInclude') }}
                      </label>
                      <br>
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="0" 
                             id="search_keyword_list_0"
                             >
                      <label class="form-check-label" 
                             for="search_keyword_list_0" 
                             style="font-size:14px; margin-left: 5px;">
                             {{ localize('search_KeywordAtach') }}
                      </label>
                    </div>
                </div>
                    <!-- <div class="col col-md-4 mb-4">
                        <label for="exc_keywords" class="form-labels">{{ localize('exclude_keywords') }}</label>
                        <input type="text"
                            class="form-control @error('exc_keywords') is-invalid text-danger @enderror"
                            id="exc_keywords" name="exc_keywords" placeholder="{{ localize('keyword_example') }}"
                            autocomplete="off">
                        <small class="text-danger"></small>
                    </div> -->
                </div>
            </div>
            </div>

            <!-- Collapse Tabs 2 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseTimeFrame" role="button"
                aria-expanded="false" aria-controls="collapseTimeFrame" id="timeCollapseFrame">
                <span id="toggleIconTimeFrame"> {{ localize('search_timeframe') }} +</span>
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
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseAttachments" role="button"
                aria-expanded="false" aria-controls="collapseTimeAttach" id="searchAttachmentDoc">
                <span id="toggleIconAttachment"> {{ localize('search_attachments') }} +</span> 
            </p>
            <div class="collapse" id="collapseAttachments">
                <div class="row mb-4">
                    <div class="col col-md-6">
                        <!-- Option for 0 value -->
                        <input name="search_attachments_list" type="hidden" value="0" id="search_attachments_list_0">
                        <!-- Option for 1 value -->
                        <input class="form-check-input mt-2" 
                            name="search_attachments_list" 
                            type="radio" 
                            value="1" 
                            id="search_attachments_list_1">
                        <label class="form-check-label" 
                            for="search_attachments_list_1" 
                            style="font-size:16px; margin-left: 5px;">
                            I want a list of all attachments only, no email correspondence
                        </label>
                        <br>
                        <input class="form-check-input mt-2" 
                            name="search_attachments_list" 
                            type="radio" 
                            value="2" 
                            id="search_attachments_list_2">
                        <label class="form-check-label" 
                            for="search_attachments_list_2" 
                            style="font-size:16px; margin-left: 5px;">
                            I want all the correspondence plus the list of all attachments
                        </label>

                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 4 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseLanguage" role="button"
                aria-expanded="false" aria-controls="collapseLanguage" id="searchDocument">
                <span id="toggleDocument"> {{ localize('document_language') }} +</span>
            </p>
            <div class="collapse" id="collapseLanguage">
                <div class="row mb-3">
                    <div class="col col-md-2">
                        <select class="form-select form-select-lg @error('language') is-invalid text-danger @enderror"
                            name="language" aria-label=".form-select-lg example">
                            <option value="{{ urlencode('en') }}"
                                {{ old('language', $order->language ?? '') == 'en' ? 'selected' : '' }}>
                                {{ localize('english') }}</option>
                            <option value="{{ urlencode('he') }}"
                                {{ old('language', $order->language ?? '') == 'he' ? 'selected' : '' }}>
                                {{ localize('hebrew') }}</option>
                        </select>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btnGenerate" id="btn-generate" type="submit">{{ localize('generate_pdf') }}</button>
        </div>
    </form>

@endif

<script>
    // Add event listener for the toggle functionality
    document.getElementById('toggleCollapses').addEventListener('click', function () {
        const icons = document.getElementById('toggleIcons');
        const isCollapseds = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapseds) {
            icons.innerHTML = "{{ localize('search_keywords') }} -";
        } else {
            icons.innerHTML = "{{ localize('search_keywords') }} +";
        }
    });

    document.getElementById('timeCollapseFrame').addEventListener('click', function () {
        const icon = document.getElementById('toggleIconTimeFrame');
        const isCollapsed = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsed) {
            icon.innerHTML = "{{ localize('search_timeframe') }} -";
        } else {
            icon.innerHTML = "{{ localize('search_timeframe') }} +";
        }
    });

    document.getElementById('searchAttachmentDoc').addEventListener('click', function () {
        const icon = document.getElementById('toggleIconAttachment');
        const isCollapsed = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsed) {
            icon.innerHTML = "{{ localize('search_attachments') }} -";
        } else {
            icon.innerHTML = "{{ localize('search_attachments') }} +";
        }
    });

    document.getElementById('searchDocument').addEventListener('click', function () {
        const icon = document.getElementById('toggleDocument');
        const isCollapsed = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsed) {
            icon.innerHTML = "{{ localize('document_language') }} -";
        } else {
            icon.innerHTML = "{{ localize('document_language') }} +";
        }
    });


</script>