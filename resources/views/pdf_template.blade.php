@foreach($jsonData as $email)
    <div style="page-break-after: always;">
        <h3>From: {{ $email['from'] }}</h3>
        <p>Date: {{ $email['date'] }}</p>
        <p>Subject: {{ $email['subject'] }}</p>
        <p>To: {{ $email['to'] }}</p>
        <p>Body:</p>
        <div>{!! $email['body'] !!}</div>
    </div>
@endforeach