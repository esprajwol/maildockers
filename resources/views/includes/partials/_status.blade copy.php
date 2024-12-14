<style>
    td {
        font-size: 1.6rem;
    }
</style>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">

            <div class="card-body">
                <h3 class=""><b>Downloads Page</b></h3>
                <div class="table-responsive">
                    @if ($orders->count() > 0)
                        <table class="table table-striped table-bordered table-hover" id="priceTable">

                            <thead>

                                <tr style="background-color: #333333;color:white">
                                    <th> {{ localize('Time') }} </th>
                                    <th> {{ localize('Order By') }}</th>
                                    <th> {{ localize('With') }} </th>

                                    <th> {{ localize('Keywords') }} </th>
                                    <th style="text-align: center" colspan="2"> {{ localize('Status') }} </th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $platformTypes = [
                                        1 => 'Gmail',
                                        2 => 'Outlook',
                                        3 => 'WhatsApp',
                                        4 => 'OpenAI Advice',
                                        5 => 'Gemini Advice',
                                    ];
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td><img style="width: 10%" src="{{ asset('web/assets/img/pdf.png') }}"
                                                alt="pdf"> &nbsp;{{ $order->created_at->format('d-m-Y H:i:s') }}
                                        </td>
                                        <td><b>{{ $order->from_email }}</b></td>
                                        <td><b>{{ $order->recipient_email }}</b></td>

                                        <td>{{ $order->keyword }}</td>
                                        @if ($order->status == 'Generating')
                                            <td style="width: 130px;"> <b>{{ $order->status }}</b></td>
                                            <td>
                                                <button class="btn progress-button"
                                                    style="position: relative; width: 130px;">
                                                    <div class="progress" style="height: 2.5rem;">
                                                        <div class="progress-bar progress-bar-striped"
                                                            role="progressbar"
                                                            style="width: 68%; font-size: 1.6rem; line-height: 2.5rem;"
                                                            aria-valuenow="68" aria-valuemin="0" aria-valuemax="100">
                                                            68%
                                                        </div>
                                                    </div>
                                                </button>
                                            </td>
                                        @elseif ($order->status == 'Done')
                                            <td><b>{{ $order->status }}</b></td>
                                            <td><a target="_blank" download=""
                                                    href="{{ route('download.done.pdf', $order->pdf_file) }}"
                                                    class="btn"
                                                    style="font-size: 1.6rem;background-color:#FF6704;color:white">Download
                                                    PDF</a></td>
                                        @elseif ($order->status == 'Downloaded')
                                            <td><b>{{ $order->status }}</b></td>
                                            <td> <a href="#" class="btn"
                                                    style="font-size: 1.6rem;background-color:#FF6704;color:white">Generate
                                                    Again</a></td>
                                        @endif
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Render pagination links -->
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <p>You don't have any orders.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
