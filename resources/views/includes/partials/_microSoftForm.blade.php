<h1 class="heading">{{ localize('email_to_pdf') }}</h1>
<p class="form-paragraph">{{ localize('address_prompt') }}</p>
@if($generateAgain)
    <form data-action="{{ route('web.microsoft.generate') }}" id="outlook-filter-form" data-login-state="{{ session('userName') ? 1:0 }}"
          data-auth-url="{{ url('microsoft/signin') }}">
        @csrf
        @method('POST')
        <div class="row flex-column flex-md-row mb-3">
            <div class="col col-md-4">
                <input type="email"
                       id="your_email"
                       class="form-control @error('your_email') is-invalid text-danger @enderror"
                       name="your_email"
                       placeholder="{{ localize('user_microsoft_email') }}"
                       autocomplete="off"
                       value="{{ old('your_email',$order->from_email) }}"
                       required />
                <small class="text-danger"></small>
            </div>
            <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">{{ localize('and') }}</p>
            <div class="col col-md-4">
                <input type="email" id="email_from"
                       class="form-control @error('email_from') is-invalid text-danger @enderror"
                       name="email_from"
                       placeholder="{{ localize('colleague_email') }}" autocomplete="off"
                       value="{{ old('email_from',$order->recipient_email) }}"
                       required />
                <small class="text-danger"></small>
            </div>
        </div>

        <p class="form-paragraph">{{ localize('microsoft_support') }}</p>

        <div class="collapse-tabs mt-5">
            <!-- Collapse Tabs 1 -->
            <p class="collapse-title mt-5 mb-3" data-bs-toggle="collapse" href="#collapseKeyWordsSection" role="button"
   aria-expanded="false" aria-controls="collapseKeyWords" id="toggleCollapseKeyword">
    <span id="toggleIconKeyword"> {{ localize('search_keywords') }} +</span>
</p>
            <div class="collapse" id="collapseKeyWordsSection">
                <div class="row flex-column">
                    <div class="col col-md-4 mb-4">
                        <label for="inc_keywords" class="form-labels">{{ localize('keyword_instruction') }}</label>
                        <input type="text" class="form-control @error('inc_keywords') is-invalid text-danger @enderror"
                               id="inc_keywords" name="inc_keywords" placeholder="keyword a, keyword b, keyword c"
                               autocomplete="off"
                               value="{{ old('inc_keywords', $order->keyword ?? '') }}"
                        >
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
                        <input type="text" class="form-control @error('exc_keywords') is-invalid text-danger @enderror"
                               id="exc_keywords" name="exc_keywords" placeholder="{{ localize('keyword_example') }}"
                               autocomplete="off" value="{{ old('exc_keywords', $order->exclude_keyword ?? '') }}">
                        <small class="text-danger"></small>
                    </div> -->
                </div>
            </div>

            <!-- Collapse Tabs 2 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseTimeFrameSection" role="button" id="timeCollapseKeyword"
               aria-expanded="false" aria-controls="collapseTimeFrame">
                <span id="toggleIconTime"> {{ localize('search_timeframe') }} +</span>
            </p>
            <div class="collapse" id="collapseTimeFrameSection">
                <div class="row mb-4">
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('starts') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                               class="form-control @error('start_date') is-invalid text-danger @enderror datepicker"
                               id="microsoft_start_date" name="start_date" placeholder="yyyy-mm-dd" autocomplete="off"
                               value="{{ old('start_date', $order->start_date ?? '') }}" >
                        <small class="text-danger"></small>
                    </div>
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('ends') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                               class="form-control @error('end_date') is-invalid text-danger @enderror datepicker"
                               id="microsoft_end_date" name="end_date" placeholder="yyyy-mm-dd" autocomplete="off"
                               value="{{ old('end_date', $order->end_date ?? '') }}">
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 3 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseAttachmentss" role="button"
                aria-expanded="false" aria-controls="collapseTimeFrame"  id="documentCollapAttach">
                <span id="toggleIconSearchAttach"> {{ localize('search_attachments') }} +  </span>
            </p>
            <div class="collapse" id="collapseAttachmentss">
                <div class="row mb-4">
                    <input name="search_attachments_list" type="hidden" value="0" id="search_attachments_list_0">
                    <div class="col col-md-6">
                      <!-- Option for 1 value -->
                      <input class="form-check-input mt-2" 
                             name="search_attachments_list" 
                             type="radio" 
                             value="1" 
                             id="search_attachments_list_1" 
                             {{ (old('search_attachments_list', $order->search_attachments_list ?? 0) == 1) ? 'checked' : '' }}>
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
                             id="search_attachments_list_2" 
                             {{ (old('search_attachments_list', $order->search_attachments_list ?? 0) == 2) ? 'checked' : '' }}>
                      <label class="form-check-label" 
                             for="search_attachments_list_2" 
                             style="font-size:16px; margin-left: 5px;">
                        I want all the correspondence plus the list of all attachments
                      </label>
                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 4 -->
          <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseLanguages" role="button"
               aria-expanded="false" aria-controls="collapseLanguage"  id="documentCollapLang">
               <span id="toggleIconSearchLang">  {{ localize('document_language') }} +</span>
            </p>
        
            <div class="collapse" id="collapseLanguages">
                <div class="row mb-3">
                    <div class="col col-md-2">
                        <select class="form-select form-select-lg @error('language') is-invalid text-danger @enderror"
                                name="language" aria-label=".form-select-lg example">
                            <option  value="{{ urlencode('en') }}" {{ old('language', $order->language ?? '')  == 'en' ? 'selected' : '' }}>
                                {{ localize('english') }}
                            </option>
                            <option value="{{ urlencode('he') }}" 
                                {{ old('language', $order->language ?? '')  == 'he' ? 'selected' : '' }}>
                                {{ localize('hebrew') }}
                            </option>
                        </select>
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group">
            <button class="btnGenerate" id="outlook-btn-generate" type="submit">@lang('lang.txt169')</button>
        </div>
    </form>
@else
    <form data-action="{{ route('web.microsoft.generate') }}" id="outlook-filter-form" data-login-state="{{ session('userName') ? 1:0 }}"
          data-auth-url="{{ url('microsoft/signin') }}">
        @csrf
        @method('POST')
        <div class="row flex-column flex-md-row mb-3">
            <div class="col col-md-4">
                <input type="email"
                       id="your_email"
                       class="form-control @error('your_email') is-invalid text-danger @enderror"
                       name="your_email"
                       placeholder="{{ localize('user_microsoft_email') }}"
                       autocomplete="off"
                       value="{{ session('userEmail') ? session('userEmail') : old('your_email') }}"
                       required />
                <small class="text-danger"></small>
            </div>
            <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">{{ localize('and') }}</p>
            <div class="col col-md-4">
                <input type="email" id="email_from"
                       class="form-control @error('email_from') is-invalid text-danger @enderror"
                       name="email_from"
                       placeholder="{{ localize('colleague_email') }}" autocomplete="off"
                       value="{{ old('email_from') }}"
                       required />
                <small class="text-danger"></small>
            </div>
        </div>

        <p class="form-paragraph">{{ localize('microsoft_support') }}</p>

        <div class="collapse-tabs mt-5">
            <!-- Collapse Tabs 1 -->
            <p class="collapse-title mt-5 mb-3" data-bs-toggle="collapse" href="#collapseKeyWordss" role="button"
   aria-expanded="false" aria-controls="collapseKeyWords" id="toggleCollapseKeyword">
    <span id="toggleIconKeyword"> {{ localize('search_keywords') }} +</span>
</p>
            <div class="collapse" id="collapseKeyWordss">
                <div class="row flex-column">
                    <div class="col col-md-4 mb-4">
                        <label for="inc_keywords" class="form-labels">{{ localize('keyword_instruction') }}</label>
                        <input type="text" class="form-control @error('inc_keywords') is-invalid text-danger @enderror"
                               id="inc_keywords" name="inc_keywords" placeholder="keyword a, keyword b, keyword c"
                               autocomplete="off">
                        <small class="text-danger"></small>
                    </div>

                    <!-- <div class="row mb-4">
                     <div class="col col-md-6">
                      <!-- Option for 0 value 
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="1"  class="form-control @error('search_keyword_list') is-invalid text-danger @enderror"
                             id="search_keyword_list_1" checked>
                      <label class="form-labels" 
                             for="search_keyword_list_1">
                             {{ localize('search_KeywordInclude') }}
                      </label>
                      <br>
                      <input class="form-check-input mt-2" 
                             name="search_keyword_list" 
                             type="radio" 
                             value="0" 
                             id="search_keyword_list_0"  class="form-control @error('search_keyword_list') is-invalid text-danger @enderror"
                             >
                      <label class="form-labels" 
                             for="search_keyword_list_0" >
                             {{ localize('search_KeywordAtach') }}
                      </label>
                     </div> 
                </div> -->

                <div class="row mb-4">
    <div class="col-md-6">
        <!-- Option for "Include Keywords" -->
        <div class="form-check" style="margin-bottom: 1rem;">
            <input 
                class="form-check-input @error('search_keyword_list') is-invalid text-danger @enderror" 
                name="search_keyword_list" 
                type="radio" 
                value="1" 
                id="search_keyword_list_1" 
                checked 
                style="margin-top: 0.3rem;">
            <label 
                class="form-check-label" 
                for="search_keyword_list_1" 
                style="margin-left: 0.5rem;">
                {{ localize('search_KeywordInclude') }}
            </label>
        </div>
        <!-- Option for "Attach Keywords" -->
        <div class="form-check">
            <input 
                class="form-check-input @error('search_keyword_list') is-invalid text-danger @enderror" 
                name="search_keyword_list" 
                type="radio" 
                value="0" 
                id="search_keyword_list_0" 
                style="margin-top: 0.3rem;">
            <label 
                class="form-check-label" 
                for="search_keyword_list_0" 
                style="margin-left: 0.5rem;">
                {{ localize('search_KeywordAtach') }}
            </label>
        </div>
    </div>
</div>


                    <!-- <div class="col col-md-4 mb-4">
                        <label for="exc_keywords" class="form-labels">{{ localize('exclude_keywords') }}</label>
                        <input type="text" class="form-control @error('exc_keywords') is-invalid text-danger @enderror"
                               id="exc_keywords" name="exc_keywords" placeholder="{{ localize('keyword_example') }}"
                               autocomplete="off">
                        <small class="text-danger"></small>
                    </div> -->
                </div>
            </div>

            <!-- Collapse Tabs 2 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseTimeFramess" role="button"
               aria-expanded="false" aria-controls="collapseTimeFrame"  id="timeCollapseKeyword">
               <span id="toggleIconTime"> {{ localize('search_timeframe') }} +</span>
            </p>
            <div class="collapse" id="collapseTimeFramess">
                <div class="row mb-4">
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('starts') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                               class="form-control @error('start_date') is-invalid text-danger @enderror datepicker"
                               id="microsoft_start_date" name="start_date" placeholder="yyyy-mm-dd" autocomplete="off">
                        <small class="text-danger"></small>
                    </div>
                    <p class="col-auto form-paragraph mb-0 mt-3">{{ localize('ends') }}</p>
                    <div class="col col-md-2">
                        <input type="text"
                               class="form-control @error('end_date') is-invalid text-danger @enderror datepicker"
                               id="microsoft_end_date" name="end_date" placeholder="yyyy-mm-dd" autocomplete="off">
                        <small class="text-danger"></small>
                    </div>
                </div>
            </div>

            <!-- Collapse Tabs 3 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseAttachmentss" role="button"
                aria-expanded="false" aria-controls="collapseTimeFrame"  id="documentCollapAttach">
                <span id="toggleIconSearchAttach"> {{ localize('search_attachments') }} +  </span>
            </p>
            <div class="collapse" id="collapseAttachmentss">
                <div class="row mb-4">
                    <input name="search_attachments_list" type="hidden" value="0" id="search_attachments_list_0">
                    <div class="col col-md-6">
                        <!-- Option for 1 value -->
                        <input class="form-check-input mt-2" 
                            name="search_attachments_list" 
                            type="radio" 
                            value="1" 
                            id="search_attachments_list_1" class="form-control @error('search_attachments_list') is-invalid text-danger @enderror">
                        <label class="form-labels" 
                            for="search_attachments_list_1" 
                            style="font-size:16px; margin-left: 5px;">
                            I want a list of all attachments only, no email correspondence
                        </label>
                        <br>
                        <input class="form-check-input mt-2" 
                            name="search_attachments_list" 
                            type="radio" 
                            value="2" 
                            id="search_attachments_list_2"  class="form-control @error('search_attachments_list') is-invalid text-danger @enderror">
                        <label class="form-labels" 
                            for="search_attachments_list_2" 
                            style="font-size:16px; margin-left: 5px;">
                            I want all the correspondence plus the list of all attachments
                        </label>
                    </div>
                </div>
            </div>
        
            <!-- Collapse Tabs 4 -->
            <p class="collapse-title mt-3" data-bs-toggle="collapse" href="#collapseLanguages" role="button"
               aria-expanded="false" aria-controls="collapseLanguage"  id="documentCollapLang">
               <span id="toggleIconSearchLang">  {{ localize('document_language') }} +</span>
            </p>
            
            <div class="collapse" id="collapseLanguages">
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

        @if(session('userName'))
            <div class="form-group">
                <button class="btnGenerate" id="outlook-btn-generate" type="submit">{{ localize('generate_pdf') }}</button>
            </div>
        @else
            <div class="form-group">
                <button class="btnGenerate" id="btn-generate" type="submit">{{ localize('generate_pdf') }}</button>
            </div>
        @endif
    </form>
@endif


<script>
    // Add event listener for the toggle functionality
    document.getElementById('toggleCollapseKeyword').addEventListener('click', function () {
        console.log('hi');
        const iconKey = document.getElementById('toggleIconKeyword');
        const isCollapsedKey = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsedKey) {
            iconKey.innerHTML = "{{ localize('search_keywords') }} -";
        } else {
            iconKey.innerHTML = "{{ localize('search_keywords') }} +";
        }
    });

    document.getElementById('timeCollapseKeyword').addEventListener('click', function () {
        const icons = document.getElementById('toggleIconTime');
        const isCollapseds = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapseds) {
            icons.innerHTML = "{{ localize('search_timeframe') }} -";
        } else {
            icons.innerHTML = "{{ localize('search_timeframe') }} +";
        }
    });

    document.getElementById('documentCollapAttach').addEventListener('click', function () {
        const icon = document.getElementById('toggleIconSearchAttach');
        const isCollapsed = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsed) {
            icon.innerHTML = "{{ localize('search_attachments') }} -";
        } else {
            icon.innerHTML = "{{ localize('search_attachments') }} +";
        }
    });

    document.getElementById('documentCollapLang').addEventListener('click', function () {
        const icon = document.getElementById('toggleIconSearchLang');
        const isCollapsed = this.getAttribute('aria-expanded') === 'true';

        // Toggle the + and - sign
        if (isCollapsed) {
            icon.innerHTML = "{{ localize('document_language') }} -";
        } else {
            icon.innerHTML = "{{ localize('document_language') }} +";
        }
    });


</script>
