<section class="pdf-message-collection">
    @if($eData->getFromEmail() == $emailTo || $eData->getFromEmail() == $authUser)
        <div class="message-counter-head">
            <div class="ram float-left">
                <p class="text-1">{{ $num }}</p>
            </div>
            <div class="ram float-left">
                <p class="text-2">{{ date('d-m-Y H:i', strtotime($eData->getDate())) }}</p>
            </div>
            <div class="clear-both"></div>
        </div>
        @php
        $message = $eData->getHtmlBody();
        $decoded_message = html_entity_decode($message);
        
        $decoded_message = preg_replace('/<br\s*\/?>/', '', $decoded_message);
        $decoded_message = preg_replace('/<style\b[^>]*>.*?<\/style>/s', '', $decoded_message);
        $decoded_message = preg_replace('/<script\b[^>]*>.*?<\/script>/s', '', $decoded_message);

        $decoded_message = strip_tags($decoded_message);
        // $texts = preg_split('/<[^>]*>/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);
        $texts = preg_split('/[,]/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);



        $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
        // ini_set('memory_limit', '-1');
        @endphp
        <div class="message-body">
            @php
            $subString = $eData->getSubject();
            foreach ($inc_array as $subWord) {
                $subPattern = "/\b" . preg_quote($subWord, '/') . "\b/i";
                $subReplacement = '<span style="background: yellow; color: #333;">$0</span>';
        
                if (preg_match($subPattern, $subString)) {
                    $subString = preg_replace($subPattern, $subReplacement, $subString);
                }
            }
            @endphp

            @if($language == 'heb')
                <h3 class="subjects">נושא: <span dir="rtl">{!! isset($subString) ? $subString : $eData->getSubject() !!}</span></h3>
            @else
                <h3 class="subjects">Subject: <span dir="rtl">{!! isset($subString) ? $subString : $eData->getSubject() !!}</span></h3>
            @endif

            @if(!$eData->getDeliveredTo())
                <h3 class="sub-subjects">{{ $eData->getFromEmail() }} sent to {{ $emailTo }}</h3>
            @else
                <h3 class="sub-subjects">{{ $eData->getFromEmail() }} sent to {{ $eData->getDeliveredTo() }}</h3>
            @endif

            @if(isset($texts[1]))
            <div class="content" dir="{{ preg_match($rtl_chars_pattern, $texts[1]) ? 'rtl':'ltr' }}" tyle="text-align:justify">
            @else
            <div class="content" id="text-body" style="text-align:justify">
            @endif

            @php
            
            foreach ($texts as $key => $string) {
                foreach ($inc_array as $word) {
                    $pattern = "/\b" . preg_quote($word, '/') . "\b/i";
                    $replacement = '<span style="background: yellow; color: #333;">$0</span>';
            
                    if (preg_match($pattern, $string)) {
                        $texts[$key] = preg_replace($pattern, $replacement, $string);
                    }
                }
            }
            @endphp

            @foreach ($texts as $string)
                {!! trim($string) !!},<br>
            @endforeach

            </div>
        </div>
    @endif
</section>