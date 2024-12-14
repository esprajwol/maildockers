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
            <h1>LegalPDF</h1>
        </div>
        <div class="content">
            <h2>Here is your PDF</h2>
            <p>You can download your PDF by clicking the link below:</p>
            <a href="{{ route("web.download",["file" => $filePath]) }}"
               class="downloadBtn">
                Download PDF
            </a>
            <p style="margin-top: 10px"><small>PDF File will be  deleted after download.</small></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} LegalPDF. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
