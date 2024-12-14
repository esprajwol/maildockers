<html lang="{{ $language }}" dir="{{ isset($direction) ? $direction : 'ltr' }}">

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>LegalPDF - PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali&family=Noto+Sans+Devanagari&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans Bengali', 'Noto Sans Devanagari', sans-serif;
        }
    </style>
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
            text-align: center;
        }

        .right-align {
            float: right;
            width: 75%;
            padding-left: 3rem;
        }

        .pdf-logo-holder {
            width: 95px;
            height: 95px;
            margin: 0 auto;
            /* Center the logo-holder horizontally */
            padding-bottom: 10px;
            /* Add space below the logo */
        }

        .pdf-logo-holder img {
            width: 100%;
            height: auto;
            display: block;
            /* Ensure the image takes up its container's space */
            margin: 0 auto;
        }

        .logo-slogan {
            color: #c3b019;
            font-weight: bold;
            font-size: 1rem;
            margin-top: 15px;
            /* Add space above the slogan */
            text-align: center;
            display: block;
            /* Ensure it is on a separate line */
        }

        .title {
            color: #c3b019;
            font-size: 1.2rem;
            /*text-align: left;*/
        }

        .paragraph {
            font-size: 0.9rem;
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

        .card-p,
        .card-c {
            text-align: center;
            box-sizing: border-box;
            margin: 0;
        }

        .card-c h1 {
            font-size: 1rem;
            font-weight: bold;
            margin: 10px;
            color: #7a7a7a;
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
            margin-bottom: 30px;
            padding-top: 10px;
        }

        .pdf-message-collection-attachment {
            margin-bottom: 20px;
            padding-top: 5px;
        }

        section.pdf-message-collection .message-body .content {
            color: #7a7a7a;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5rem
        }

          section.pdf-message-collection-attachment .message-body .content {
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

        .number,
        .subject,
        .date {
            color: #7a7a7a;
            font-size: 1rem;
        }

        .numberDiv,
        .dateDiv,
        .subjectDiv {
            margin-bottom: 10px;
        }

        .from-to-container {
            font-size: 1rem;
            color: #7a7a7a;
            margin-bottom: 10px;
        }

        .text-bold {
            font-weight: bold;
        }

        [lang="EN-US"] {
            direction: ltr;
            text-align: left;
        }
    </style>
</head>

<body>

    {{-- Localization Text --}}
    <div class="h-wrapper" dir="{{ $direction }}">
        <div class="left-align">
            <div class="pdf-logo-holder">
                <img src="{{ $logo }}" alt="logo">
            </div>
            <h3 class="logo-slogan">{{ localize('fast_and_secure') }}</h3>
        </div>
        <div class="right-align">
            <p class="title">{{ localize('email_organization') }}</p>
            <p class="paragraph">
                {{ localize('pdf_short') }}
            </p>
            <p class="paragraph"><a href="https://legalpdf.co" style="color: blue" target="_blank">www.LegalPDF.co</a> |
                +44 2 089 850 107</p>
        </div>
        <div class="clear-both"></div>
    </div>
    <hr class="bold-line">


    <section class="pdf-invoice">
        <div class="order-details-card">
            <p class="card-title">{{ localize('order_details') }}</p>
            <div class="card-items">
                <div class="item">
                    <span class="{{ $direction == 'rtl' ? 'float-right' : 'float-left' }}"
                        dir="{{ $direction }}">{{ localize('ordered_by') }}</span>
                    <span class="{{ $direction == 'rtl' ? 'float-left' : 'float-right' }}">
                        {!! htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') !!}
                        |
                        {!! htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') !!}
                    </span>
                </div>
                <div class="item">
                    <span class="{{ $direction == 'rtl' ? 'float-right' : 'float-left' }}"
                        dir="{{ $direction }}">{{ localize('pdf_date') }}</span>
                    <span class="{{ $direction == 'rtl' ? 'float-left' : 'float-right' }}"
                        dir="{{ $direction }}">{!! htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') !!}
                        {{ localize('pdf_at') }} {!! htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') !!}</span>
                </div>
                <div class="item">
                    <span class="{{ $direction == 'rtl' ? 'float-right' : 'float-left' }}"
                        dir="{{ $direction }}">{{ localize('pdf_platform') }}</span>
                    <span class="{{ $direction == 'rtl' ? 'float-left' : 'float-right' }}">{{ $platform }}</span>
                </div>
                <div class="item">
                    <span class="{{ $direction == 'rtl' ? 'float-right' : 'float-left' }}"
                        dir="{{ $direction }}">{{ localize('pdf_no_conversation') }}</span>
                    <span
                        class="{{ $direction == 'rtl' ? 'float-left' : 'float-right' }}">{!! htmlspecialchars($countData, ENT_QUOTES, 'UTF-8') !!}</span>
                </div>

                @if ($allow_attachments > 0)
                    <div class="item">
                        <span
                            class="{{ $direction == 'rtl' ? 'float-right' : 'float-left' }}">{{ localize('pdf_list_all_attachments') }}</span>
                        <span
                            class="{{ $direction == 'rtl' ? 'float-left' : 'float-right' }}">{{ htmlspecialchars($total_document_count, ENT_QUOTES, 'UTF-8') }}</span>
                    </div>
                @endif

            </div>
        </div>
        <div class="additional-card">
            <p class="card-title">{{ localize('pdf_doc_between') }}</p>
            <div class="card-box">
                <div class="card-p text-center">
                    <p><span class="content">{!! htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') !!}</span></p>
                    <p><span class="content">{!! htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') !!}</span></p>
                </div>
                <div class="card-c text-center">
                    <h1>And</h1>
                </div>
                <div class="card-p text-center">
                    <p><span class="content">{!! htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8') !!}</span></p>
                    <p><span class="content">{!! htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8') !!}</span></p>
                </div>
            </div>
        </div>
        <div class="clear-both"></div>

        @if(in_array($allow_attachments, ["0", "2"]))
            <p class="notes">* {{ localize('pdf_msg_short') }}</p>
        @endif

    </section>

    <section>
        @foreach ($htmlData as $html)
            {!! $html !!}
        @endforeach
    </section>
</body>

</html>
