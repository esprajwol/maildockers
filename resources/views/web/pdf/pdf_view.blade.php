<section class="pdf-message-collection">
    <div class="message-counter-head" style="width: 100%">
        <div class="numberDiv">
            <span  style="font-size:1.4rem;color: #7a7a7a">{{ sprintf('%02d', $num) }}</span>
        </div>
        <div class="text-center subjectDiv">
            @php
                $subString = $eData['subject'];
            @endphp

            @if (isset($language) && $language == 'he')
                <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">נושא: <span dir="rtl"><b>{!! $subString !!}</b></span></span>
            @else
                <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">Subject: <span dir="rtl"><b>{!! $subString !!}</b></span></span>
            @endif
        </div>
        <div class="dateDiv">
            <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">{{ $eData['date'] }}</p>
        </div>
    </div>
    <div class="from-to-container" style="margin-bottom: 5px">
        <span style="color: #7a7a7a;font-size:1.4rem;font-weight:bold"><b> {{ extractName($eData['from']) }} to
                {{ extractName($eData['to']) }}</b> </span>
    </div>
    @php
        $message = $eData['body'];
        //print_r($message);
        $decoded_message = strip_tags(html_entity_decode($message));

        $texts = preg_split('/[,.]/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);

        $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
    @endphp

    <div class="message-body">
        <div class="content" dir="{{ preg_match($rtl_chars_pattern, $decoded_message) ? 'rtl' : 'ltr' }}"
            style="text-align:justify;font-size:1.2rem">
            <?php
            echo $message;
            ?>
        </div>
    </div>
</section>
