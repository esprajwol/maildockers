<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env("APP_NAME","LegalPDF") }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            direction: {{$direction}};
        }
        .email-container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            width: 50px;
            height: 50px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            margin: 0 0 20px;
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #888888;
        }

        .downloadBtn{
            background: olive;
            color: #fff;
            padding: 11px 20px;
            font-size: 0.7rem;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://legalpdf.co/./web/assets/img/resize-image/android-chrome-192x192.png" alt="LegalPDF Logo">
            <br>
        </div>
        {{ localize('your_requested_document_is_ready_to_download') }}
        <a href="{{ empty($order->pdf_file) ? "#" : route('download.done.pdf', ['id' => $order->id, 'file_name' => $order->pdf_file]) }}">{{ localize('click_here_to_access_it') }}</a>
        <br>
        <br>
        {{ localize('thank_you') }}

    </div>
</body>
</html>
