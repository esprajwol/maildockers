<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>LegalPDF - PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        body {
            font-size: 62.5%;
            padding: 4rem 3rem;
            max-width: 100%;
            font-family: DejaVu Sans, sans-serif;
            unicode-bidi: bidi-override !important;
            direction: unset !important
        }

        .text-right {
            text-align: right
        }

        .left-align {
            width: 25%
        }

        .right-align {
            width: 75%
        }

        .float-left {
            float: left
        }

        .float-right {
            float: right
        }

        .clear-both {
            clear: both
        }

        .pdf-logo-holder {
            width: 15rem;
            height: auto;
            overflow: hidden;
            margin: 0 auto
        }

        .pdf-logo-holder>img {
            width: 100%;
            height: 10rem;
            -o-object-fit: contain;
            object-fit: contain
        }

        header.pdf-header {
            border-bottom: .15rem solid #7a7a7a
        }

        header.pdf-header h3.logo-slogan {
            font-size: 1.5rem;
            line-height: 2.4rem;
            color: #999903;
            text-align: center;
            font-weight: bold;
            margin: 1rem 0
        }

        header.pdf-header h3.title {
            font-size: 2.2rem;
            line-height: 2.8rem;
            color: #999903;
            font-weight: bold;
            margin-left: 1rem;
            margin-bottom: 0
        }

        header.pdf-header p.paragraph {
            color: #7a7a7a;
            font-size: 1.7rem;
            font-weight: 400;
            line-height: 3rem;
            margin-left: 1rem
        }

        section.pdf-invoice .order-details-card {
            margin-bottom: 1.5rem
        }

        section.pdf-invoice .order-details-card h3.card-title {
            font-size: 2rem;
            line-height: 2.6rem;
            color: #7a7a7a;
            font-weight: bold
        }

        section.pdf-invoice .order-details-card .card-items {
            padding: 1rem 0
        }

        section.pdf-invoice .order-details-card .card-items .item {
            border-bottom: .15rem dashed #7a7a7a;
            padding: 1rem 0;
            /*display: flex;*/
            color: #7a7a7a;
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        section.pdf-invoice .order-details-card .card-items .item span:last-child {
            float: right;
            display: inline-block;
        }

        section.pdf-invoice .order-details-card .card-items .item span {
            font-weight: bold
        }

        section.pdf-invoice .additional-card {
            margin: 1.5rem 0
        }

        section.pdf-invoice .additional-card p.card-title {
            font-size: 1.7rem;
            line-height: 2.6rem;
            color: #7a7a7a;
            text-align: center;
            font-weight: bold;
            margin-bottom: 1.5rem
        }

        section.pdf-invoice .additional-card h3.card-title {
            font-size: 1.6rem;
            line-height: 2.6rem;
            color: #7a7a7a;
            text-align: center;
            font-weight: bold;
            margin-bottom: 1.5rem
        }

        section.pdf-invoice .additional-card .card-box {
            max-width: 70%;
            border: .15rem solid #7a7a7a;
            padding: 1rem;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        section.pdf-invoice .additional-card .card-box .card-p {
            width: 45%;
            text-align: center;
        }

        section.pdf-invoice .additional-card .card-box .card-c {
            width: 10%;
            text-align: center;
        }

        section.pdf-invoice .additional-card .card-box h3.title-1 {
            font-size: 1.7rem;
            line-height: 2.4rem;
            color: #7a7a7a;
            font-weight: bold;
        }


        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        section.pdf-invoice p.notes {
            text-align: center;
            color: #7a7a7a;
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        section.pdf-message-collection .message-counter-head {
            border-top: .15rem solid #7a7a7a;
            padding-top: 1rem;
            margin-top: 2.5rem
        }

        section.pdf-message-collection .message-counter-head p.text-1 {
            color: #7a7a7a;
            font-size: 1.7rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        .label {
            text-align: right;
            color: #7a7a7a;
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        .content {
            font-size: 1.6rem;
            font-weight: 400;
            color: #7a7a7a;
            font-weight: bold;
        }

        section.pdf-message-collection .message-counter-head p.text-2 {
            text-align: right;
            color: #7a7a7a;
            font-size: 1.7rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        section.pdf-message-collection .message-body h3.subjects {
            font-size: 1.8rem;
            line-height: 2.4rem;
            color: #7a7a7a
        }

        section.pdf-message-collection .message-body h3.sub-subjects {
            font-size: 1.5rem;
            line-height: 2rem;
            color: #7a7a7a
        }

        section.pdf-message-collection .message-body .content {
            color: #7a7a7a;
            font-size: 1.7rem;
            font-weight: 400;
            line-height: 2.3rem
        }

        .pdf-page-footer {
            width: 100%
        }

        .pdf-page-footer .title {
            text-align: center
        }

        footer.pdf-page-footer h3.title {
            font-size: 1.6rem;
            line-height: 2.3rem;
            color: #7a7a7a;
            text-align: center;
            font-weight: bold
        }

        .pdf-page-header {
            width: 100%;
            padding: 0;
            margin: 1rem auto
        }

        .pdf-page-header .pdf-repeat {
            width: 33.33%
        }

        header.pdf-page-header h3.title-1 {
            font-size: 1.5rem;
            line-height: 2.4rem;
            color: #999903;
            font-weight: bold
        }

        .manage-font {
            font-size: 1.6rem;
            color: #7a7a7a;
            font-weight: bold;
        }

        header.pdf-page-header h3.title-2 {
            font-size: 1.5rem;
            line-height: 2.4rem;
            color: #7a7a7a;
            text-align: center;
            font-weight: bold
        }

        header.pdf-page-header h3.title-3 {
            font-size: 1.5rem;
            line-height: 2.4rem;
            color: #999903;
            text-align: right;
            font-weight: bold
        }

        .message-counter-head {
            width: 100%
        }

        .message-counter-head .ram {
            width: 50%
        }
    </style>
    <style>
        body {
            unicode-bidi: bidi-override !important;
            direction: unset !important;
        }

        .highlight {
            background-color: yellow;
        }

        .bold-line {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            border: 1px solid;
            color: black;

        }
    </style>
</head>

<body>

    <div class='h-wrapper'>
        <div class='left-align float-left'>
            <div class='pdf-logo-holder'>
                <img src='https://legalpdf.co/web/assets/img/resize-image/android-chrome-192x192.png' alt='logo'
                    loading="lazy" />
            </div>
            <h3 class='logo-slogan text-center'
                style=" color: #c3b019de;font-weight: bold; margin-top: 6px;font-size: 1.6rem; ">
                FAST & SECURED
            </h3>
        </div>
        <div class='right-align float-left' style="padding-left:3rem ">
            <p class='title' style=" color: #c3b019de; font-size:1.8rem ">Email's Messages into an Organised Document
            </p>
            <div class='p-wrapper'>
                <p class='paragraph' style="font-size: 1.6rem;color:#7a7a7a;text-align:left">
                    This is an official document produced by LegalPDF. The Document authentically reflects
                    email correspondence between the two parties mentioned below.
                </p>
                <p class='paragraph' style="font-size: 1.6rem;color:#7a7a7a;margin-top:2.95rem">
                    www.LegalPDF.co | +44 2 089 850 107
                </p>
            </div>
        </div>
        <div class='clear-both'></div>
    </div>
    <hr class="bold-line">
    <?php
    $accessToken = 'ya29.a0AXooCgu9eAtZplPDh-1P5gTkI3yAyXDGNUQ93E48n3qbNZhZffrGxXnOFDmEMcZGWEUii-xMctvwZqr3jZGTWQRLDGguTORsXD33IyRZ_2rOxfTRhoq_Dq4pCibskuAUSTPDhg3aLlrytvvH3SvYs73U5bLpe55laUodaCgYKAaMSARMSFQHGX2MiN6o8OkGZxqjjojN1mMmP5w0171';
    $url = 'https://www.googleapis.com/gmail/v1/users/me/messages';

    $headers = [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTPGET, true); // Use GET request instead of POST

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['messages'])) {
            $messageCount = 0;
            foreach ($data['messages'] as $message) {
                if ($messageCount >= 10) {
                    break; // Stop fetching more messages once we have 10
                }

                $messageId = $message['id'];
                $messageUrl = 'https://www.googleapis.com/gmail/v1/users/me/messages/' . $messageId;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $messageUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HTTPGET, true);

                $messageResponse = curl_exec($ch);
                curl_close($ch);

                if ($messageResponse) {
                    $messageData = json_decode($messageResponse, true);
                    if (isset($messageData['snippet'])) {
                        echo "Message ID: " . $messageId . "\n";
                        echo "Thread ID: " . $messageData['threadId'] . "\n";
                        echo "Snippet: " . $messageData['snippet'] . "\n";
                        echo "\n";
                    }
                }

                $messageCount++;
            }
        } else {
            echo "No messages found.";
        }
    } else {
        echo "Failed to fetch messages.";
    }
    ?>





    <section class='pdf-invoice'>
        <div class='order-details-card'>
            <p class='card-title text-center manage-font'>Order details</p>
            <div class='card-items'>
                <div class='item'>
                    <span>Ordered by </span>
                    <span style="float: right; display: inline-block"> Zohar | Zohar@gmail.com </span>
                </div>
                <div class='item'>
                    <span>Date: </span>
                    <span>17/07/2024 at 7:44 </span>
                </div>
                <div class='item'>
                    <span>Platform: </span>
                    <span>Gmail </span>
                </div>
                <div class='item'>
                    <span>Number of emails: </span>
                    <span>320</span>
                </div>
            </div>
        </div>
        <div class='additional-card'>
            <p class='card-title'>The following document contains emails between</p>
            <div class='card-box'>

                <div class='card-p float-left'>
                    <p class='text-center'><span class="label">Name:</span>&nbsp;<span class="content">Zohar</span></p>
                    <p class='text-center'><span class="label">Email: </span>&nbsp;<span
                            class="content">Zohar@gmail.com</span></p>
                </div>

                <div class='card-c float-left'>
                    <h1 class='text-center'><span class="content">And</span></h1>
                </div>

                <div class='card-p float-left'>
                    <p class='text-center'><span class="label">Name:</span> <span class="content">Mike</span></p>
                    <p class='text-center'><span class="label">Email:</span> <span
                            class="content">Mike@gmail.com</span></p>
                </div>

                <div class='clear-both'></div>
            </div>
        </div>
        <p class='notes'>* The following emails are in order from newest to oldest</p>
    </section>

    @for ($i = 0; $i < 20; $i++)
        {{-- Message Body as pdf_view.blade.php --}}
        <section class="pdf-message-collection">

            <div class="message-counter-head" style="display: flex; justify-content: space-between">
                <div class=" text-left">
                    <p class="text-1">{{ sprintf('%02d', $i + 1) }}</p>
                </div>

                <div class="text-center">
                    @php
                        $subString = 'Legal PDF Laravel';
                    @endphp

                    @if (isset($language) && $language == 'heb')
                        <p><span class="label">נושא: </span><span class="content"
                                dir="rtl">{!! $subString !!}</span></p>
                    @else
                        <p><span class="label"> Subject:</span> <span class="content"
                                dir="rtl">{!! $subString !!}</span></p>
                    @endif
                </div>

                <div class="">
                    <p class="label">2024-07-07 12:30</p>
                </div>
            </div>
            @php
                $message = 'XYZ';
                $decoded_message = strip_tags(html_entity_decode($message), '<br>');
                $texts = preg_split('/[,.]/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);
                $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
            @endphp

            <div class="message-body">
                @php
                    $subString = 'Legal PDF Laravel';
                    foreach ([] as $subWord) {
                        $subPattern = '/\b' . preg_quote($subWord, '/') . '\b/i';
                        $subString = preg_replace(
                            $subPattern,
                            '<span style="background: yellow; color: #333;">$0</span>',
                            $subString,
                        );
                    }
                @endphp
                {{--                <h3 class="sub-subjects"> rislam252@gmail.com sent to riponuddin@gmail.com</h3> --}}

                <div class="content" dir="{{ preg_match($rtl_chars_pattern, $decoded_message) ? 'rtl' : 'ltr' }}"
                    style="text-align:justify">
                    <p><b> Mr Zohr Sent to Mike > </b> </p>
                    <p style="padding:0 60px; font-size: 1.3rem ">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It
                        has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                        containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                        PageMaker including versions of Lorem Ipsum.
                    </p>
                </div>
            </div>
        </section>
    @endfor
</body>

</html>
