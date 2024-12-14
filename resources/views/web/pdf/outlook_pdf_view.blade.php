<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LegalPDF - PDF</title>
    <style>
        *{margin:0;padding:0;-webkit-box-sizing:border-box;box-sizing:border-box}body{font-size:62.5%;padding:4rem 3rem;max-width:100%;font-family:DejaVu Sans,sans-serif;unicode-bidi:bidi-override!important;direction:unset!important}.text-right {text-align: right}.left-align{width:25%}.right-align{width:75%}.float-left{float:left}.float-right{float:right}.clear-both{clear:both}.pdf-logo-holder{width:15rem;height:auto;overflow:hidden;margin:0 auto}.pdf-logo-holder>img{width:100%;height:auto;-o-object-fit:contain;object-fit:contain}header.pdf-header{border-bottom:.15rem solid #7a7a7a}header.pdf-header h3.logo-slogan{font-size:1.5rem;line-height:2.4rem;color:#999903;text-align:center;font-weight:bold;margin:1rem 0}header.pdf-header h3.title{font-size:2.2rem;line-height:2.8rem;color:#999903;font-weight:bold;margin-left:1rem;margin-bottom:0}header.pdf-header p.paragraph{color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:3rem;margin-left:1rem}section.pdf-invoice .order-details-card{margin-bottom:1.5rem}section.pdf-invoice .order-details-card h3.card-title{font-size:2rem;line-height:2.6rem;color:#7a7a7a;font-weight:bold}section.pdf-invoice .order-details-card .card-items{padding:1rem 0}section.pdf-invoice .order-details-card .card-items .item{border-bottom:.15rem dashed #7a7a7a;padding:1rem 0;display:flex;color:#7a7a7a;font-size:1.6rem;font-weight:400;line-height:2.3rem}section.pdf-invoice .order-details-card .card-items .item span{font-weight:bold}section.pdf-invoice .additional-card{margin:1.5rem 0}section.pdf-invoice .additional-card h3.card-title{font-size:1.8rem;line-height:2.6rem;color:#7a7a7a;text-align:center;font-weight:bold;margin-bottom:1.5rem}section.pdf-invoice .additional-card .card-box{max-width:90%;border:.15rem solid #7a7a7a;padding:1rem;margin:0 auto}section.pdf-invoice .additional-card .card-box .card-p{width:45%}section.pdf-invoice .additional-card .card-box .card-c{width:10%}section.pdf-invoice .additional-card .card-box h3.title-1{font-size:1.7rem;line-height:2.4rem;color:#7a7a7a;font-weight:bold}.text-center{text-align:center}.text-right{text-align:right}section.pdf-invoice p.notes{text-align:center;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}section.pdf-message-collection .message-counter-head{border-top:.15rem solid #7a7a7a;padding-top:1rem;margin-top:2.5rem}section.pdf-message-collection .message-counter-head p.text-1{color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}section.pdf-message-collection .message-counter-head p.text-2{text-align:right;color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}section.pdf-message-collection .message-body h3.subjects{font-size:1.8rem;line-height:2.4rem;color:#7a7a7a}section.pdf-message-collection .message-body h3.sub-subjects{font-size:1.5rem;line-height:2rem;color:#7a7a7a}section.pdf-message-collection .message-body .content{color:#7a7a7a;font-size:1.7rem;font-weight:400;line-height:2.3rem}.pdf-page-footer{width:100%}.pdf-page-footer .title{text-align:center}footer.pdf-page-footer h3.title{font-size:1.6rem;line-height:2.3rem;color:#7a7a7a;text-align:center;font-weight:bold}.pdf-page-header{width:100%;padding:0;margin:1rem auto}.pdf-page-header .pdf-repeat{width:33.33%}header.pdf-page-header h3.title-1{font-size:1.5rem;line-height:2.4rem;color:#999903;font-weight:bold}header.pdf-page-header h3.title-2{font-size:1.5rem;line-height:2.4rem;color:#7a7a7a;text-align:center;font-weight:bold}header.pdf-page-header h3.title-3{font-size:1.5rem;line-height:2.4rem;color:#999903;text-align:right;font-weight:bold}.message-counter-head{width:100%}.message-counter-head .ram{width:50%}
    </style>
    <style>
        body {
            unicode-bidi: bidi-override !important;
            direction: unset !important;
        }
    </style>
</head>

<body @if($language == 'heb') dir="rtl" @endif>
    <header class="pdf-header">
        @if($language == 'heb')
        <div class="h-wrapper">
            <div class="left-align float-right">
                <div class="pdf-logo-holder">
                    <img src="{{ $logo }}" alt="logo">
                </div>
                <h3 class="logo-slogan">מאובטח ומהיר</h3>
            </div>
            <div class="right-align float-right" style="text-align: right;">
                <h3 class="title text-right">מחלץ התכתבויות דוא"ל ל- PDF</h3>
                <div class="p-wrapper">
                    <p class="paragraph text-right">
                        זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט.
                        המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.
                    </p>
                    <p class="paragraph text-right">
                        למידע נוסף, אנא בקרו באתר com.legalpdf.
                    </p>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
        @else
        <div class="h-wrapper">
            <div class="left-align float-left">
                <div class="pdf-logo-holder">
                    <img src="{{ $logo }}" alt="logo">
                </div>
                <h3 class="logo-slogan">FAST & SECURED</h3>
            </div>
            <div class="right-align float-left">
                <h3 class="title">Emails and Chats Extractor</h3>
                <div class="p-wrapper">
                    <p class="paragraph">
                        This is a formal document ready to be used, created by LegalPDF.
                        The document contains all the requested information by the client.
                    </p>
                    <p class="paragraph">
                        For more information, please visit legalpdf.co otherwise contact us
                        on info@legalpdf.co or +44 208 5053 311
                    </p>
                </div>
            </div>
            <div class="clear-both"></div>
        </div>
        @endif
    </header>

    <section class="pdf-invoice">
        @if($language == 'heb')
        <div class="order-details-card">
            <h3 class="card-title">פרטי הזמנה</h3>
            <div class="card-items">
                <div class="item">
                    <span> ידי על ה</span>
                    <span>{{ $username }} | {{ $authUser }}</span>
                </div>
                <div class="item">
                    <span>תאריך </span>
                    <span>{{ $dateAt }} at {{ $timeAt }}</span>
                </div>
                <div class="item">
                    <span>פלטפורמה </span>
                    <span>Microsoft Outlook</span>
                </div>
                <div class="item">
                    <span>כמות תכתובות </span>
                    <span>{{ count($data) }}</span>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</h3>
            <div class="card-box">
                <div class="card-p float-left">
                    <h3 class="title-1">{{ $authUser }}</h3>
                </div>
                <div class="card-c float-left">
                    <h3 class="title-1 text-center">עם</h3>
                </div>
                <div class="card-p float-left">
                    <h3 class="title-1 text-right">{{ $emailTo }}</h3>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">התכתובות הבאות מסודרות מהחדש ביותר בראש המסמך, ועד הישן ביותר בתחתית המסמך</p>
        @else
        <div class="order-details-card">
            <h3 class="card-title">Order details</h3>
            <div class="card-items">
                <div class="item">
                    <span>Ordered by </span>
                    <span>{{ $username }} | {{ $authUser }}</span>
                </div>
                <div class="item">
                    <span>Date: </span>
                    <span>{{ $dateAt }} at {{ $timeAt }}</span>
                </div>
                <div class="item">
                    <span>Platform: </span>
                    <span>Microsoft Outlook</span>
                </div>
                <div class="item">
                    <span>Number of emails: </span>
                    <span>{{ count($data) }}</span>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">The following document contains emails between</h3>
            <div class="card-box">
                <div class="card-p float-left">
                    <h3 class="title-1">{{ $authUser }}</h3>
                </div>
                <div class="card-c float-left">
                    <h3 class="title-1 text-center">and</h3>
                </div>
                <div class="card-p float-left">
                    <h3 class="title-1 text-right">{{ $emailTo }}</h3>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">* The following emails are in order from newest to oldest</p>
        @endif
    </section>

    @if (count($data))
        <section class="pdf-message-collection">
            @foreach ($data as $eData)
                <div class="message-counter-head">
                    <div class="ram float-left">
                        <p class="text-1">{{ $loop->iteration }}</p>
                    </div>
                    <div class="ram float-left">
                        <p class="text-2">{{ date('d-m-Y H:i', strtotime($eData['receivedDateTime'])) }}</p>
                    </div>
                    <div class="clear-both"></div>
                </div>
                @php
                    $message = $eData['body']['content'];
                    $decoded_message = html_entity_decode($message);
                    $plain_message = strip_tags($decoded_message);
                    $texts = preg_split('/<[^>]*>/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);

                    $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
                @endphp
                <div class="message-body">
                    @if($language == 'heb')
                    <h3 class="subjects">נושא: <span dir="rtl">{{ $eData['subject'] }}</span></h3>
                    @else
                    <h3 class="subjects">Subject: <span dir="rtl">{{ $eData['subject'] }}</span></h3>
                    @endif

                    @if(isset($eData['from']) && isset($eData['toRecipients']))
                    <h3 class="sub-subjects">{{ $eData['from']['emailAddress']['name'] }} sent to {{ $eData['toRecipients'][0]['emailAddress']['name'] }}</h3>
                    @else
                    <h3 class="sub-subjects">sent to {{ isset($eData['from']['emailAddress']['name']) ? $eData['from']['emailAddress']['name']:''}} {{ isset($eData['toRecipients'][0]['emailAddress']['name']) ? $eData['toRecipients'][0]['emailAddress']['name']:'' }}</h3>
                    @endif

                    @if(isset($texts[1]))
                    <div class="content" dir="{{ preg_match($rtl_chars_pattern, $texts[1]) ? 'rtl':'ltr' }}" style="text-align:justify">
                    @else
                    <div class="content" style="text-align:justify">
                    @endif
                        @foreach ($texts as $text)
                            {{ trim($text) . "\n" }}
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    @endif
</body>

</html>
