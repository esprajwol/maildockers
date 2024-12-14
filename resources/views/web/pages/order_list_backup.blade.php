@if ($orders->count() > 0)
    @foreach ($orders as $order)
        <tr>
            <td style="width:200px">
                <img style="width: 10%" src="{{ asset('web/assets/img/pdf.png') }}" alt="pdf"> &nbsp;
                {{ $order->created_at->format('d-m-Y H:i:s') }}
            </td>
            <td><b>{{ $order->from_email }}</b></td>
            <td><b>{{ $order->recipient_email }}</b></td>
            <td>{{ $order->keyword }}</td>
            <td><b>{{ $order->status }}</b></td>

            @if ($order->status == 'Generating')
                <td>
                    <div id="jobProgressShowHere_{{ $order->id }}">
                        <div class="progress" style="position: relative; height: 2rem;">
                            <div class="progress-bar progress-bar-striped" role="progressbar"
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
                <td>
                    <a target="_blank" download href="{{ empty($order->pdf_file) ? "#" : route('download.done.pdf', ['id' => $order->id, 'file_name' => $order->pdf_file]) }}"
                        class="btn" style="font-size: 1.2rem;background-color:#FF6704;color:white" id="downloadLink">
                        Download PDF
                    </a>
                </td>
            @elseif ($order->status == 'Downloaded')
                <td>
                    <a id="generate-again-{{ $order->id }}" href="{{ route('generate.again', $order->id) }}"
                        class="btn generate-again" style="font-size: 1.2rem;background-color:#FF6704;color:white">
                        Generate New
                    </a>
                </td>
            @else
                <td></td>
            @endif
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6">You don't have any orders.</td>
    </tr>
@endif
