<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Footer</title>
    <style>
        .pdf-page-footer {
            text-align: center;
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #7a7a7a;
        }

        .title {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="pdf-page-footer">
    <h3 class="title">- {{ $query['page'] }} of {{ $query['topage'] }} -</h3>
</div>
</body>
</html>
