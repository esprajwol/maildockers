@extends('dashboard.version1.layouts.main')

@section('title', localize('Order'))
@section('top-header', localize('Order'))

@section('content')
<style>
.orderTableBody td {
	font-weight: bold;
}
</style>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <tbody class="orderTableBody">
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td style="width:15%;vertical-align: middle; text-align:center;">
                                                <img style="width: 50%" src="{{ asset('web/assets/img/pdf.png') }}" alt="pdf"> &nbsp;
                                            </td>
                                            <td style="width:90%">
                                                <table width="100%">
                                                    <tr class="border-bottom">
                                                        <td>Date & Time</td>
                                                        <td class="text-right"><b>{{ convertToLocalDateTime($order->created_at) }}</b></td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Target Mail</td>
                                                        <td class="text-right">{{ $order->recipient_email }}</td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Keywords</td>
                                                        <td class="text-right"><b>{{ $order->keyword }}</b></td>
                                                    </tr>
                                                    <tr class="border-bottom">
                                                        <td>Platform</td>
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
                                                                    Unknown Platform
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                    <tr class="border-bottom">

                                                        @if ($order->status == 'Generating')
                                                            <td style="color:green"><b>{{ $order->status }}</b></td>
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
                                                                </script>
                                                            @endif
                                                        @elseif (!empty($order->pdf_file))
                                                            <td><b>{{ $order->status }}</b></td>
                                                            <td class="text-right">
                                                                <a target="_blank" download href="{{ empty($order->pdf_file) ? "#" : route('download.done.pdf', ['id' => $order->id, 'file_name' => $order->pdf_file]) }}"
                                                                    class="btn m-2" style="font-size: 1rem;background-color:#FF6704;color:white" id="downloadLink">
                                                                    Download PDF
                                                                </a>
                                                            </td>
                                                        @elseif ($order->status == 'Downloaded')
                                                            <td>{{ $order->status }}</td>
                                                            <td class="text-right">
                                                                <a id="generate-again-{{ $order->id }}" href="{{ route('generate.again', $order->id) }}"
                                                                    class="btn generate-again m-2" style="font-size: 1rem;background-color:#FF6704;color:white">
                                                                    Generate New
                                                                </a>
                                                            </td>
                                                        @elseif($order->status == 'Refund')
                                                            <td>{{ $order->status }}</td>
                                                            <td class="text-right">
                                                                @if($order->refund && $order->refund->latestStatus)
                                                                    Refund: {{$order->refund->latestStatus->status}}
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td style="color:red"><b>{{ $order->status }}</b></td>
                                                            <td class="text-left">
                                                                <div class="status-bar failed">
                                                                    <span class="failed-text">Unfortunately, we couldn't generate the document that you requested.</span>
                                                                    <ul class="failed-options">
                                                                        <li><a href="#" id="requestRefundLink" data-order-id="{{ $order->id }}">> Submit a report and request a refund</a></li>
                                                                        <li><a href="#" id="requestRegeneratePdf" data-order-id="{{ $order->id }}">> Try to generate the document again (free of charge)</a></li>
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
                                        <td colspan="6">You don't have any orders.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section("js")
    <script>
        $('.select2').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    </script>
@endsection
