<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Here is the title</title>
    <style>
        /* If using CSS, ensure page breaks are handled properly */
        .page-break {
            page-break-before: always;
        }

    </style>

</head>
<body>

    <h1>WK-HTML-to-PDF</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
    </p>

    @foreach($htmlData as $html)
        {!! $html !!}
    @endforeach

</body>
</html>
