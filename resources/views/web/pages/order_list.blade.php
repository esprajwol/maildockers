@if ($orders->count() > 0)
    @foreach ($orders as $order)
        <tr style="border-bottom: 10px solid grey;">
            <td style="width:15%;vertical-align: middle; text-align:center;">
                <img style="width: 50%" src="{{ asset('web/assets/img/pdf.png') }}" alt="pdf"> &nbsp;
            </td>
            <td style="width:90%">
                <table width="100%">
                    <tr class="border-bottom">
                        <td>{{ localize('date_time') }}</td>
                        <td class="text-right"><b>{{ convertToLocalDateTime($order->created_at) }}</b></td>
                    </tr>
                    <tr class="border-bottom">
                        <td>{{ localize('target_mail') }}</td>
                        <td class="text-right">{{ $order->recipient_email }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td>{{ localize('keywords') }}</td>
                        <td class="text-right"><b>{{ $order->keyword }}</b></td>
                    </tr>
                    @if(!in_array($order->status, ["Failed", "Downloaded", "Done"]))
                        <tr class="border-bottom">
                            <td>{{ localize('notify_me_when_document_is_ready') }}</td>
                            <td class="text-right float-end">
                                @if($order->notify == 1)
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" value="{{$order->id}}" id="notify_me" onclick="notify_order_email(this)" checked>
                                </div>
                                @else
                                <div class="form-check form-switch">
                                  <input class="form-check-input" type="checkbox" value="{{$order->id}}" id="notify_me" onclick="notify_order_email(this)">
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @if(!in_array($order->status, ["Failed", "Downloaded", "Done"]))
                        <tr class="border-bottom">
                            <td>{{ localize('estimate_time_to_finish') }}</td>
                            <td class="text-right">
                                @if($order->processing_status == 0)
                                    <span class="countdown-{{$order->id}}" data-duration="{{ $order->total_messages * 3 }}" id="countdown-{{ $order->id }}"> {{ localize('calculating_estimated_time') }} </span>
                                @else
                                    @if($order->status == "Failed")
                                        {{ localize('failed') }}
                                    @else
                                        <span class="countdown-{{$order->id}}" data-duration="{{ $order->total_messages * 3 }}" id="countdown-{{ $order->id }}"> </span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr class="border-bottom">
                        <td>{{ localize('platform') }}</td>
                        <td class="text-right">
                            @php
                                $platformType = $order->platform_type; // Assuming $order is your model instance
                            @endphp
                            @switch($platformType)
                                @case(1)
                                    Gmail
                                    @break
                                @case(2)
                                    Outlook
                                    @break
                                @case(3)
                                    WhatsApp
                                    @break
                                @default
                                {{ localize('unknown_platform') }}
                            @endswitch
                        </td>
                    </tr>
                    <tr class="border-bottom">

                        @if ($order->status == 'Generating')
                            <td style="color:green"><b>{{ localize($order->status) }}</b></td>
                            <td class="text-right">
                                <div id="jobProgressShowHere_{{ $order->id }}" style="padding-right: 0px; margin-right:0px">
                                    <div class="progress" style="position: relative; height: 2rem;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                            style="width: {{ $order->progress['progress'] ?? 5 }}%; font-size: 1.2rem; line-height: 2rem; text-align: center;"
                                            aria-valuenow="{{ $order->progress['progress'] ?? 5 }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ $order->progress['progress'] ?? 5 }}%
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @if($order->is_paid)
                                <script>
                                    fetchProgress({{ $order->id }});
                                    fetchAndStartTimer({{ $order->id }});
                                </script>
                            @endif
                        @elseif (!empty($order->pdf_file))
                            <td><b>{{ localize($order->status) }}</b></td>
                            <td class="text-right">
                                <a target="_blank" download href="{{ empty($order->pdf_file) ? "#" : route('download.done.pdf', ['id' => $order->id, 'file_name' => $order->pdf_file]) }}"
                                    class="btn m-2" style="font-size: 1rem;background-color:#FF6704;color:white" id="downloadLink">
                                    {{ localize('download_pdf') }}
                                </a>
                            </td>
                        @elseif ($order->status == 'Downloaded')
                            <td>{{ localize($order->status) }}</td>
                            <td class="text-right">
                                <a id="generate-again-{{ $order->id }}" href="{{ route('generate.again', $order->id) }}"
                                    class="btn generate-again m-2" style="font-size: 1rem;background-color:#FF6704;color:white">
                                    {{ localize('generate_new') }}
                                </a>
                            </td>
                        @elseif($order->status == 'Refund')
                            <td>{{ localize($order->status) }}</td>
                            <td class="text-right">
                                @if($order->refund && $order->refund->latestStatus)
                                {{ localize('refund') }}: {{$order->refund->latestStatus->status}}
                                @endif
                            </td>
                        @else
                            <td style="color:red"><b>{{ localize($order->status) }}</b></td>
                            <td class="text-left">
                                <div class="status-bar failed">
                                    <span class="failed-text">{{ localize('unfortunately_we_couldnt_generate_the_document_that_you_requested') }}</span>
                                    <ul class="failed-options">
                                        <li><a href="#" id="requestRefundLink" data-order-id="{{ $order->id }}">>{{ localize('submit_a_report_and_request_a_refund') }}</a></li>
                                        <li><a href="#" id="requestRegeneratePdf" data-order-id="{{ $order->id }}">> {{ localize('try_to_generate_the_document_again_free_of_charge') }}</a></li>
                                    </ul>
                                </div>
                            </td>
                        @endif
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6">{{ localize('no_record') }}</td>
    </tr>
@endif
