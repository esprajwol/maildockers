<html lang="{{$language}}">

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>LegalPDF - PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            max-width: 100%;
            font-family: DejaVu Sans, sans-serif;
            unicode-bidi: bidi-override !important;
            direction: unset !important;
        }

        .text-center {
            text-align: center;
        }

        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }


        .clear-both {
            clear: both;
        }

        /* PDF Styles */
        .h-wrapper {
            margin-bottom: 20px;
        }

        .left-align {
            float: left;
            width: 25%;
        }

        .right-align {
            float: right;
            width: 75%;
            padding-left: 3rem;
        }

        .pdf-logo-holder {
            width: 95px;
            height: 95px;
            overflow: hidden;
        }

        .pdf-logo-holder img {
            width: 100%;
            height: auto;
        }

        .logo-slogan {
            color: #c3b019;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 6px;
        }

        .title {
            color: #c3b019;
            font-size: 1.6rem;
            text-align: left;
        }

        .paragraph {
            font-size: 1rem;
            color: #7a7a7a;
            margin-top: 1rem;
        }

        .bold-line {
            border: none;
            border-top: 2px solid #c3b019;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Order Details Card */
        .order-details-card {
            padding: 20px;
            margin-top: 20px;

        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #7a7a7a;
        }

        .card-items {
            font-size: 1rem;
            color: #7a7a7a;
        }

        .item {
            margin-top: 20px;
            overflow: hidden;
            border-bottom: 1px dashed #7a7a7a;
            margin-bottom: 5px;
        }

        .item span {
            font-weight: bold;
        }

        .item .float-left {
            float: left;
        }

        .item .float-right {
            float: right;
        }

        /* Additional Card Styles */
        .additional-card {
            padding: 20px;
        }

        .card-box {
            width: 100%;
            overflow: hidden;
            margin: 0 auto;
            border: 1px solid #7a7a7a;
            padding: 25px;
        }

        .card-p, .card-c {
            display: inline-block;
            vertical-align: top;
        }

        .card-p {
            width: 40%;
            text-align: left;
            box-sizing: border-box;
            margin: 0;
        }

        .card-c {
            width: 10%;
            text-align: center;
            box-sizing: border-box;
            margin: 0;
        }

        .card-c h1 {
            font-size: 1rem;
            font-weight: bold;
            color: #c3b019;
        }

        .label {
            color: #7a7a7a;
        }

        .notes {
            margin-top: 8px;
            margin-bottom: 15px;
            font-size: 1rem;
            color: #7a7a7a;
            text-align: center;
        }

        .content {
            color: #7a7a7a;
            font-weight: bold;
        }

        /* Hebrew Language Styles */
        .rtl {
            direction: rtl;
        }

        .rtl .left-align {
            float: right;
        }

        .rtl .right-align {
            float: right;
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .pdf-message-collection {
            border-top: 2px solid #7a7a7a;
            margin-bottom: 20px;
            padding-top: 10px;
        }

        section.pdf-message-collection .message-body .content {
            color: #7a7a7a;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5rem
        }

        .message-counter-head {
            width: 100%;
            overflow: hidden;
            margin: 0 auto;
            margin-bottom: 1rem;
        }

        .number, .subject, .date {
            color: #7a7a7a;
            display: inline-block;
            vertical-align: top;
        }

        .number {
            font-size: 16px;
        }

        .subject {
            font-size: 15px;
        }

        .date {
            font-size: 12px;
        }

        .numberDiv, .subjectDiv, .dateDiv {
            box-sizing: border-box;
            margin: 0;
            display: inline-block;
            vertical-align: top;
        }

        .numberDiv {
            width: 13%;
            text-align: left;
        }

        .subjectDiv {
            width: 70%;
        }

        .dateDiv {
            width: 13%;
            text-align: right;
        }

        .from-to-container {
            font-size: 1rem;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body dir="{{$language == 'he' ? 'rtl': ''}}">
@if($language == 'he')
    {{--Hebrew--}}
    <div class="rtl h-wrapper">
        <div class="left-align">
            <div class="pdf-logo-holder">
                <img src="{{$logo}}" alt="logo">
            </div>
            <p class="logo-slogan">מאובטח ומהיר</p>
        </div>
        <div class="right-align">
            <p class="title">מחלץ התכתבויות דוא'ל ל- PDF</p>
            <p class="paragraph">
                זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט.
                המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.
            </p>
            <p class="paragraph">www.LegalPDF.co | +44 2 089 850 107</p>
        </div>
        <div class="clear-both"></div>
    </div>
    <hr class="bold-line">
@else
    {{--English--}}
    <div class="h-wrapper">
        <div class="left-align">
            <div class="pdf-logo-holder">
                <img src="{{$logo}}" alt="logo">
            </div>
            <h3 class="logo-slogan">FAST & SECURED</h3>
        </div>
        <div class="right-align">
            <p class="title">Email's Messages into an Organised Document</p>
            <p class="paragraph">
                This is an official document produced by LegalPDF. The Document authentically reflects
                email correspondence between the two parties mentioned below.
            </p>
            <p class="paragraph">www.LegalPDF.co | +44 2 089 850 107</p>
        </div>
        <div class="clear-both"></div>
    </div>
    <hr class="bold-line">
@endif

<section class="pdf-invoice">
    @if($language == 'he')
        {{--Hebrew--}}
        <div class="order-details-card">
            <p class="card-title">פרטי ההזמנה</p>
            <div class="card-items">
                <div class="item">
                    <span class="float-left">הוזמן על ידי:</span>
                    <span
                        class="float-right">{{htmlspecialchars($username, ENT_QUOTES, 'UTF-8')}} | {{htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
                <div class="item">
                    <span class="float-left">תאריך:</span>
                    <span
                        class="float-right">{{htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8')}} ב-{{htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
                <div class="item">
                    <span class="float-left">פלטפורמה:</span>
                    <span class="float-right">Gmail</span>
                </div>
                <div class="item">
                    <span class="float-left">מספר מיילים:</span>
                    <span class="float-right">{{htmlspecialchars($countData, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <p class="card-title">המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</p>
            <div class="card-box">
                <div class="card-p float-left">
                    <p><span class="label">שם:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8')}}</span></p>
                    <p><span class="label">מייל:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8')}}</span></p>
                </div>
                <div class="card-c text-center">
                    <h1><span class="content">ו</span></h1>
                </div>
                <div class="card-p float-right">
                    <p><span class="label">שם:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8')}}</span></p>
                    <p><span class="label">מייל:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8')}}</span></p>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>
        <p class="notes">* ההתכתבויות הבאות מסודרות מהחדש ביותר בראש המסמך ועד הישן ביותר בתחתית המסמך</p>
    @else
        {{--English--}}
        <div class="order-details-card">
            <p class="card-title">Order details</p>
            <div class="card-items">
                <div class="item">
                    <span class="float-left">Ordered by:</span>
                    <span
                        class="float-right">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8')}} | {{htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
                <div class="item">
                    <span class="float-left">Date:</span>
                    <span
                        class="float-right">{{htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8')}} at {{htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
                <div class="item">
                    <span class="float-left">Platform:</span>
                    <span class="float-right">Gmail</span>
                </div>
                <div class="item">
                    <span class="float-left">Number of emails:</span>
                    <span class="float-right">{{htmlspecialchars($countData, ENT_QUOTES, 'UTF-8')}}</span>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <p class="card-title">The following document contains emails between:</p>
            <div class="card-box">
                <div class="card-p float-left">
                    <p><span class="label">Name:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8')}}</span></p>
                    <p><span class="label">Email:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8')}}</span></p>
                </div>
                <div class="card-c text-center">
                    <h1><span class="content">And</span></h1>
                </div>
                <div class="card-p float-right">
                    <p><span class="label">Name:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8')}}</span></p>
                    <p><span class="label">Email:</span>&nbsp;<span
                            class="content">{{htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8')}}</span></p>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>
        <p class="notes">* The following emails are in order from newest to oldest</p>
    @endif
</section>

<section>
    @foreach($jsonData as $email)
        <section class="pdf-message-collection">
            <div class="message-counter-head">
                <div class="numberDiv">
                    <span class="number">{{ sprintf('%02d', $loop->iteration) }}</span>
                </div>
                <div class="subjectDiv">
                    @php
                        $subString = $email['subject'];
                    @endphp

                    @if (isset($language) && $language == 'he')
                        <span class="subject">נושא: <span
                                dir="rtl"><b>{!! $subString !!}</b></span></span>
                    @else
                        <span class="subject">Subject: <span><b>{!! $subString !!}</b></span></span>
                    @endif
                </div>
                <div class="dateDiv">
                    <span class="date">{{ $email['date'] }}</span>
                </div>
            </div>
            <div class="clear-both"></div>
            <div class="from-to-container">
                <span>
                    From: {{ extractName($email['from']) }} To {{ extractName($email['to']) }}
                </span>
            </div>
            @php
                $message = $email['body'];
                //print_r($message);
                $decoded_message = strip_tags(html_entity_decode($message));

                $texts = preg_split('/[,.]/', $decoded_message, -1, PREG_SPLIT_NO_EMPTY);

                $rtl_chars_pattern = '/[\x{0590}-\x{05ff}\x{0600}-\x{06ff}]/u';
            @endphp

            <div class="message-body">
                <div class="content" dir="{{ preg_match($rtl_chars_pattern, $decoded_message) ? 'rtl' : 'ltr' }}"
                     style="text-align:justify;font-size:1rem;margin-top: 8px">
                    <?php
                    echo $message;
                    ?>
                </div>
            </div>
        </section>
    @endforeach
</section>
</body>
</html>