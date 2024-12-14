@php
    $message = str_replace('�', '', $eData['body']);
@endphp

@if(in_array($isAttachmentSelected, ["0", "2"]))
<section class="pdf-message-collection">
    @if(isset($language) && $language == 'he')
        <div class="message-counter-head text-bold" dir="rtl">
            <div class="numberDiv">
                <span class="number" dir="rtl">
                    <span>מספר הודעה:</span>
                    <span dir="ltr">{{ sprintf('%02d', $count) }}</span>
                </span>
            </div>
            <div class="dateDiv">
                <span class="date" dir="rtl">
                    <span>תאריך:</span>
                    <span dir="ltr">{{$date}}</span>
                    |
                    <span>שעה:</span>
                    <span dir="ltr">{{$time}}</span>
                </span>
            </div>
            <div class="from-to-container">
                <span dir="rtl">
                    <span dir="auto">{{ $eData['senderName'] }}</span>
                    <span dir="rtl">כותב ל>></span>
                    <span dir="auto">{{ $eData['receiverName'] }}</span>
                </span>
            </div>
            <div class="subjectDiv">
                @php
                    $subString = $eData['subject'];
                @endphp
                <span class="subject" dir="rtl">
                    <span>נושא:</span>
                    <span dir="auto">{!! $subString !!}</span>
                </span>
            </div>
        </div>
    @else
        <div class="message-counter-head text-bold">
            <div class="numberDiv">
                <span class="number">Message Number: {{ sprintf('%02d', $count) }}</span>
            </div>
            <div class="dateDiv">
                <span class="date">Date: {{$date}}  |  Time: {{$time}}</span>
            </div>
            <div class="from-to-container">
                <span>{{ $eData['senderName'] }} writes to >> {{ $eData['receiverName'] }}</span>
            </div>
            <div class="subjectDiv">
                @php
                    $subString = $eData['subject'];
                @endphp

                <span class="subject">Subject: <span>{!! $subString !!}</span></span>
            </div>
        </div>
    @endif
    <div class="clear-both"></div>
    <div class="message-body">
        <div class="content" style="text-align:justify;font-size:1rem;margin-top: 8px;" dir="auto">
            <!-- Email content goes here -->
            {!! $message !!}
        </div>
    </div>
</section>
@endif
