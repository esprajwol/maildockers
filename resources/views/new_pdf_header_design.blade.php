<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .border-bottom {
            border-bottom: 1.2px solid #7a7a7a;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header-container {
            width: 100%;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .header-logo {
            float: left;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-info {
            overflow: hidden;
            color: #7a7a7a;
        }

        .header-info p {
            margin: 0;
        }

        .company-name {
            color: #c3b019;
            font-weight: bold;
            font-size: 14px;
        }

        .company-info {
            font-weight: bold;
            font-size: 12px;
            color: #7a7a7a;
        }

        .header-time {
            text-align: right;
            font-size: 12px;
            color: #7a7a7a;
            margin-top: -20px; /* Adjust this value to align it properly */
        }

        .color-gray {
            color: #7a7a7a;
            font-size: 12px;
        }

        .company-info-2 {
            color: #c3b019;
            font-size: 12px;
            font-weight: bold;
        }

        .pdf-page-header {
            width: 100%;
            margin-bottom: 20px;
        }
    </style>

</head>
<body>
@if($page >= 2)
    {{--Single page header--}}
    @if($language == 'en')
        <div class="border-bottom">
            <div class="header-container">
                <div class="header-logo">
                    <img src="{{$logo}}" alt="logo"/>
                </div>
                <div class="header-info">
                    <p>
                        <span class="company-name">LegalPDF.co</span><br>
                        <span class="company-info">Emails and Chats Extractor</span>
                    </p>
                </div>
                <div class="header-time">
                    <p>
                        <span class="color-gray">{{$dateAt}}  at {{$timeAt}}</span><br>
                        <span class="company-info-2">FAST & SECURED</span>
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="pdf-page-header border-bottom" dir="rtl">
            <div class="header-container">
                <div class="header-logo">
                    <img src="{{$logo}}" alt="logo"/>
                </div>
                <div class="header-info">
                    <p>
                        <span class="company-name">LegalPDF.co</span><br>
                        <span class="company-info">מחלץ התכתבויות דוא"ל ל- PDF</span>
                    </p>
                </div>
                <div class="header-time">
                    <p>
                        <span class="color-gray">{{$dateAt}}  at {{$timeAt}}</span><br>
                        <span class="company-info-2">מאובטח ומהיר</span>
                    </p>
                </div>
            </div>
        </div>
    @endif
@endif

</body>
</html>
