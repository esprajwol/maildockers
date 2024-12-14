<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ localize('order_fail_mail_title') }}</title>
</head>

<body>

    <div style="direction: {{ isset($direction) ? $direction : "ltr" }}">
        <h3>{{ localize('order_fail_mail_message') }} {{ $order->from_email }}</h3>
        <p>{{ localize('order_details') }}</p><br>
        <p>{{ localize('user_email') }}: {{ $order->from_email }}</p><br>
        <p>{{ localize('target_mail') }}: {{ $order->recipient_email }}</p><br>
        <p>{{ localize('keywords') }}: {{ $order->keyword }}</p><br>
        <p>{{ localize('platform') }}: {{ $order->platform_type == 1 ? 'Gmail' : 'Outlook' }}</p><br>
        <p>{{ localize('order_created_at') }}: {{ convertToLocalDateTime($order->created_at) }}</p><br>
        <p>{{ localize('order_failed_at') }}: {{ convertToLocalDateTime(now()) }}</p><br>
    </div>
</body>

</html>
