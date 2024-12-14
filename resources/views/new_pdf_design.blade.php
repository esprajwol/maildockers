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
<body dir="{{$language == 'he' ? 'rtl': ''}}">
<header class='pdf-header'>
    @if($language == 'he')
        {{--Hewbrew--}}
        <div style='direction: rtl;'>
            <div style='width:25%;' class='left-align float-right'>
                <div>
                    <img width='95' height='95' src="{{asset($logo)}}" alt='logo'>
                </div>
                <p class='logo-slogan' style='color: #c3b019de;font-size: 1.3rem;font-weight: bold;'> מאובטח, מהיר
                    ומעוצב</p>
            </div>
            <div class='right-align float-right' style='width:75%;text-align: right;'>

                         <span class='title' style='color: #c3b019de; font-size:1.8rem;text-align:right!important'>
                         מחלץ התכתבויות דוא'ל ל- PDF
                         </span>
                <p class='clear-both'>
                                    <span class='title'
                                          style='color: #c3b019de; font-size:1.8rem;text-align:right!important'>
                                    זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט.
                                    המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.
                                    </span>
                </p>
                <p style='font-size: 1.6rem;color:#7a7a7a;margin-top:2.7rem;text-align:left'>
                    www.LegalPDF.co | +44 2 089 850 107
                </p>

            </div>
            <div class='clear-both'></div>
        </div>
    @else
        {{--English--}}
        <div class='h-wrapper'>
            <div class='left-align float-left'>
                <div class='pdf-logo-holder'>
                    <img src='{{asset($logo)}}' alt='logo'
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
@endif
</header>
<section class='pdf-invoice'>
    @if($language == 'he')
        Hewbrew
        <div style="text-align:center;padding-top:10px;">
            <span style="color: #7a7a7a; font-size: 1.2rem; font-weight: bold;">פרטי ההזמנה</span>
        </div>
        <div class="order-details-card">
            <div class="card-items">
                <div class="item">
                    <div style="width:30%; float:right; margin-top:20px;">
                        <span style="color: #7A7A7A; font-size: 1.2rem; font-weight: bold;">הוזמן על ידי</span>
                    </div>
                    <div style="width:70%; float:left; text-align:left;">
                        <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">{{htmlspecialchars($username, ENT_QUOTES, 'UTF-8') }} | {{htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:right; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="label">תאריך</span>
                    </div>
                    <div style="width:70%; float:left; text-align:left;">
                        <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">{{htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') }} ב-{{htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:right; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">פלטפורמה</span>
                    </div>
                    <div style="width:70%; float:left; text-align:left;">
                        <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">Gmail</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:right; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">מספר מיילים:</span>
                    </div>
                    <div style="width:70%; float:left; text-align:left;">
                        <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">{{htmlspecialchars($countData, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</h3>
            <div class="card-box">
                <div class="card-p float-right">
                    <p class="text-center"><span class="label">שם: </span>&nbsp;<span class="content">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') }}</span></p>
                    <p class="text-center"><span class="label">מייל: </span>&nbsp;<span class="content">{{htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') }}</span></p>
                </div>
                <div class="card-c float-right">
                    <h1 class="text-center"><span class="content">ו</span></h1>
                </div>
                <div class="card-p float-right">
                    <p class="text-center"><span class="label">שם: </span>&nbsp;<span class="content">{{htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8') }}</span></p>
                    <p class="text-center"><span class="label">מייל: </span>&nbsp;<span class="content">{{htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8') }}</span></p>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">התכתובות הבאות מסודרות מהחדש ביותר בראש המסמך, ועד הישן ביותר בתחתית המסמך</p>
    @else
        {{--English--}}
        <div style="text-align:center;padding-top:10px;">
            <span  style="color: #7a7a7a; font-size: 1.2rem; font-weight: bold;">Order details</span>
        </div>
        <div class="order-details-card">

            <div class="card-items">
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A; font-size: 1.2rem; font-weight: bold;">Ordered by</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') }} | {{htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="label">Date</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">{{htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') }} at {{htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">Platform</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">Gmail</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">Number of emails:</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">{{htmlspecialchars($countData, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">The following document contains emails between</h3>
            <div class="card-box">
                <div class="card-p float-left">
                    <p class="text-center"><span class="label">Name: </span>&nbsp;<span class="content">{{htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') }}</span></p>
                    <p class="text-center"><span class="label">Email: </span>&nbsp;<span class="content">{{htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') }}</span></p>
                </div>
                <div class="card-c float-left">
                    <h1 class="text-center"><span class="content">And</span></h1>
                </div>
                <div class="card-p float-left">
                    <p class="text-center"><span class="label">Name: </span>&nbsp;<span class="content">{{htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8') }}</span></p>
                    <p class="text-center"><span class="label">Email: </span>&nbsp;<span class="content">{{htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8') }}</span></p>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">* The following emails are in order from newest to oldest</p>
    @endif
</section>
<section class='pdf-message-collection'>
    @foreach($jsonData as $email)
        <section class="pdf-message-collection">
            <div class="message-counter-head" style="width: 100%">
                <div class="numberDiv">
                    <span style="font-size:1.4rem;color: #7a7a7a">{{ sprintf('%02d', $loop->iteration) }}</span>
                </div>
                <div class="text-center subjectDiv">
                    @php
                        $subString = $email['subject'];
                    @endphp

                    @if (isset($language) && $language == 'he')
                        <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">נושא: <span
                                dir="rtl"><b>{!! $subString !!}</b></span></span>
                    @else
                        <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">Subject: <span
                                dir="rtl"><b>{!! $subString !!}</b></span></span>
                    @endif
                </div>
                <div class="dateDiv">
                    <span style="font-size:1.4rem;color: #7a7a7a" class="text-2">{{ $email['date'] }}</span>
                </div>
            </div>
            <div class="from-to-container" style="margin-bottom: 5px">
        <span style="color: #7a7a7a;font-size:1.4rem;font-weight:bold"><b> {{ extractName($email['from']) }} to
                {{ extractName($email['to']) }}</b> </span>
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
                     style="text-align:justify;font-size:1.2rem">
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
