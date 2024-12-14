@php
    $message = $eData['body'];
@endphp

@if (in_array($isAttachmentSelected, ['0', '2']))
    @foreach ($message as $thread)
        @if (is_array($thread))
            <section class="pdf-message-collection">
                @if (isset($language) && $language == 'he')
                    <div class="message-counter-head text-bold" dir="rtl">
                        <div class="numberDiv">
                            <span class="number" dir="rtl">
                                <span>מספר הודעה:</span>
                                <span dir="ltr">{{ sprintf('%02d', $count) }}</span>
                                <span style="color: #c3b019;" dir="rtl">פְּתִיל</span>
                                <span dir="ltr" style="color: #c3b019;">
                                    {{ $loop->iteration }} / {{ $loop->count }}
                                </span>
                            </span>
                        </div>
                        <div class="dateDiv">
                            <span class="date" dir="rtl">
                                <span>תאריך:</span>
                                <span dir="ltr">{{ $thread['date'] }}</span>
                                |
                                <span>שעה:</span>
                                <span dir="ltr">{{ $thread['time'] }}</span>
                            </span>
                        </div>
                        <div class="from-to-container">
                            <span dir="rtl">
                                <span>{{ $thread['senderName'] }}</span>
                                <span dir="rtl">כותב ל>></span>
                                <span dir="ltr">{{ $thread['receiverName'] }}</span>
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
                            <span class="number">Message Number: {{ sprintf('%02d', $count) }} </span>
                            <span style="color: #c3b019;">Thread {{ $loop->iteration }}/{{ $loop->count }}</span>
                        </div>
                        <div class="dateDiv">
                            <span class="date">Date: {{ $thread['date'] }} | Time: {{ $thread['time'] }}</span>
                        </div>
                        <div class="from-to-container">
                            <span>{{ $thread['senderName'] }} writes to >> {{ $thread['receiverName'] }}</span>
                        </div>
                        <div class="subjectDiv">
                            @php
                                $subString = $eData['subject'];
                            @endphp
                            <span class="subject">Subject: <span dir="auto">{!! $subString !!}</span></span>
                        </div>
                    </div>
                @endif

                <div class="clear-both"></div>
                <div class="message-body">
                    <div class="content" style="text-align:justify;font-size:1rem;margin-top: 8px;" dir="auto">
                        <!-- Email content goes here -->
                        {!! $thread['content'] !!}
                    </div>
                </div>

                <!-- Mail Attachments -->
                @if (in_array($isAttachmentSelected, ['1', '2']))
                    <div class="clear-both"></div>
                    <div class="message-body">
                        <div class="content" style="font-size:1rem;margin-top: 8px;color: #c3b019;" dir="auto">
                            @if (isset($thread['attachments']) && count($thread['attachments']) == 0)
                                <p>{{ localize('pdf_attachment_label') }}:
                                    <strong>{{ localize('pdf_attachment_label_none') }}</strong></p>
                            @else
                                <p>{{ localize('pdf_attachment_label') }}: </p>
                                <div>
                                    @foreach ($thread['attachments'] as $attachment)
                                        <div id="{{ $attachment['attachment_id'] }}">{{ $attachment['file_name'] }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif



            </section>
        @else
            <section class="pdf-message-collection">
                @if (isset($language) && $language == 'he')
                    <div class="message-counter-head text-bold" dir="rtl">
                        <div class="numberDiv">
                            <span class="number" dir="rtl">
                                <span>מספר הודעה:</span>
                                <span dir="ltr">{{ sprintf('%02d', $count) }}</span>
                                <span style="color: #c3b019;" dir="rtl">פְּתִיל</span>
                                <span dir="ltr" style="color: #c3b019;">
                                    {{ $loop->iteration }} / {{ $loop->count }}
                                </span>
                            </span>
                        </div>
                        <div class="dateDiv">
                            <span class="date" dir="rtl">
                                <span>תאריך:</span>
                                <span dir="ltr">{{ $thread['date'] }}</span>
                                |
                                <span>שעה:</span>
                                <span dir="ltr">{{ $thread['time'] }}</span>
                            </span>
                        </div>
                        <div class="from-to-container">
                            <span dir="rtl">
                                <span>{{ $thread['senderName'] }}</span>
                                <span dir="rtl">כותב ל>></span>
                                <span dir="ltr">{{ $thread['receiverName'] }}</span>
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
                            <span class="number">Message Number: {{ sprintf('%02d', $count) }} </span>
                            <span style="color: #c3b019;">Thread {{ $loop->iteration }}/{{ $loop->count }}</span>
                        </div>
                        <div class="dateDiv">
                            <span class="date">Date: {{ $thread['date'] }} | Time: {{ $thread['time'] }}</span>
                        </div>
                        <div class="from-to-container">
                            <span>{{ $thread['senderName'] }} writes to >> {{ $thread['receiverName'] }}</span>
                        </div>
                        <div class="subjectDiv">
                            @php
                                $subString = $eData['subject'];
                            @endphp
                            <span class="subject">Subject: <span dir="auto">{!! $subString !!}</span></span>
                        </div>
                    </div>
                @endif
                <div class="clear-both"></div>
                <div class="message-body">
                    <div class="content" style="text-align:justify;font-size:1rem;margin-top: 8px;" dir="auto">
                        <!-- Email content goes here -->
                        {!! $thread['content'] !!}
                    </div>
                </div>

            </section>
        @endif
    @endforeach
@endif
