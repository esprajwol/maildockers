@extends('dashboard.layouts.main')

@section('title', 'Notification')
@section('top_header', 'Notification')

@section('content')

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ localize("QR Code Scanned Notifications") }}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> {{ localize("SL") }} </th>
                                    <th> {{ localize(" QR Code") }} </th>
                                    <th> {{ localize("Model") }} </th>
                                    <th> {{ localize("Security No.") }} </th>
                                    <th> {{ localize("Total Scanned") }} </th>
                                    <th> {{ localize("Location") }} </th>
                                    <th> {{ localize("Date") }} </th>
                                    <th> {{ localize("Status") }} </th>
                                    <th> {{ localize("Action") }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifications as $notification)
                                    @php
                                        $data = $notification->data;
                                        $code  = findById(new \App\Models\Code(), $data['code_id']);
                                        $location = null;
                                        $date = null;
                                    @endphp
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td class="img-holder">
                                            <x-common.image :src="$code->qr_path"></x-common.image>
                                        </td>
                                        <td> {{ $code->security_no }} </td>
                                        <td> {{ $code->scanned }} </td>
                                        <td>
                                            @if ($code->informations->isNotEmpty())
                                                @php
                                                    $latestInformation = $code->informations->last();
                                                    $location = $latestInformation->cityName . ', ' . $latestInformation->countryName;
                                                    $date = $latestInformation->currentTime;
                                                @endphp

                                                <div class="alert alert-success">
                                                    IP: {{ $latestInformation->ip }}, <br>
                                                    City: {{ $latestInformation->cityName }}, <br>
                                                    Country: {{ $latestInformation->countryName }} <br>
                                                    Miami Time: {{ $latestInformation->currentTime }}
                                                </div>
                                            @else

                                            @endif
                                        </td>
                                        <td>{{ $location }}</td>
                                        <td>{{ $date }}</td>
                                        <td>
                                            <label class="badge {{ ($code->scanned > 1) ? 'badge-gradient-danger':'badge-gradient-success'}}">
                                                {{ ($code->scanned > 1) ? 'Repeat Scanned':'Correct Scanned'}}
                                            </label>
                                        </td>
                                        <td>
                                            @if(isRead($notification->read_at))
                                                <strong class="badge badge-success bd-success">{{ $notification->read_at }}</strong>
                                            @else
                                                <button type="button"
                                                        class="float-right mark-as-read btn btn-sm btn-success"
                                                        data-url="{{ route('admin.notifications.markAsRead') }}"
                                                        data-id="{{ $notification->id }}">
                                                    {{ localize('Mark as Read') }}
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <x-common.no_data colspan="7" />
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('extra-styles')
    <style>
        table td.img-holder img {
            width: 39px;
            height: 39px;
            padding: 2px;
            border: 1px solid #333;
            border-radius: unset;
        }
    </style>
@endpush

@section("js")
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
