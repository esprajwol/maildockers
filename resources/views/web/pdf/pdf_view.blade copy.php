<section class="pdf-message-collection">
        <div class="message-counter-head"
             style="width: 100%">
            <div class=" text-left numberDiv" >
                <p class="text-1">{{ sprintf('%02d', $num) }}</p>
            </div>

            <div class="text-center subjectDiv">

                @php
                    $subString = $eData["subject"];
                @endphp

                @if(isset($language) && $language == 'heb')
                    <p class="text-2">נושא: <span dir="rtl"><b>{!! $subString !!}</b></span></p>
                @else
                    <p class="text-2">Subject: <span dir="rtl"><b>{!! $subString !!}</b></span></p>
                @endif
            </div>

            <div class="dateDiv">
                <p class="text-2">{{ $eData["date"] }}</p>
            </div>
        </div>

        @php
            $message = $eData["body"];
            $decoded_message = strip_tags(html_entity_decode($message), '<br>');

            $texts = preg_split('/[,.]/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);

            $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
        @endphp

        <div class="message-body">
            @php
                $subString = $eData["subject"];
                foreach ($inc_array as $subWord) {
                    $subPattern = "/\b" . preg_quote($subWord, '/') . "\b/i";
                    $subString = preg_replace($subPattern, '<span style="background: yellow; color: #333;">$0</span>', $subString);
                }
            @endphp


            <div class="content" dir="{{ preg_match($rtl_chars_pattern, $decoded_message) ? 'rtl':'ltr' }}" style="text-align:justify">
                <p><b> {{ extractName($eData["from"])  }} to {{ extractName($eData["to"]) }} > </b> </p>

                <?php
                    foreach ($texts as $key => $string) {

                        foreach ($inc_array as $word) {
                            $pattern = "/\b" . preg_quote($word, '/') . "\b/i";
                            $bodyText = preg_replace($pattern, '<span style="background: yellow; color: #333;">$0</span>', $string);
                            ?>

                            <?= $bodyText ?>

                            <?php
                        }
                    }
                ?>

                @foreach ($texts as $finalText)
                    <p style="padding:0 60px; font-size: 1rem ">
                        {!! trim($finalText) !!},<br>
                    </p>
                @endforeach
            </div>
        </div>
</section>
