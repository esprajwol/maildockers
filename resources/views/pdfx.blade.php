

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
