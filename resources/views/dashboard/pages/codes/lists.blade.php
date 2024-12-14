@extends('dashboard.layouts.main')

@section('title', localize(' - Code Lists)')


@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                @if (isAdmin())
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('admin.code.scanned.lists') }}">{{localize('Scanned QR
                                    Codes'}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active btn-gradient-primary" aria-current="page" href="#">{{localize('All QR Codes')}}
                                    </a>
                            </li>
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <div class="card-title-holder">
                        <h4 class="card-title">{{localize('All QR Codes')}}</h4>
                        <div>
                            @if (isAdmin())
                                <a href="{{ route('admin.code.generate.each') }}"
                                    class="btn btn-gradient-primary btn-icon-text btn-sm">
                                    <i class="mdi mdi-plus btn-icon-prepend"></i> {{localize('Add New Code')}}
                                </a>
                                <a href="{{ route('admin.code.export', ['modelId' => $modelId ?? null]) }}"
                                    class="btn btn-gradient-danger btn-icon-text btn-sm">
                                    <i class="mdi mdi-upload btn-icon-prepend"></i> {{localize('Export Data')}}
                                </a>
                            @endif

                            {{-- <a href="{{ route('admin.code.generate') }}"
                            class="btn btn-gradient-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Bulk Import
                        </a> --}}

                            @if ($modelId)
                                <a href="{{ route('admin.code.zip.download', $modelId) }}"
                                    class="btn btn-gradient-success btn-icon-text btn-sm">
                                    <i class="mdi mdi-download btn-icon-prepend"></i> {{localize('Download .zip')}}
                                </a>
                            @endif
                        </div>

                    </div>
                    <hr>

                    <div class="card-title-holder">
                        <h4 class="card-title">{{localize('Filter by Model:')}} @if ($modelId)
                                @if (count($codes))
                                    {{ $codes[0]->model->model_name }}
                                @else
                                    {{localize(' N/A')}}
                                 @endif
                             @else
                                {{localize('All')}}
                            @endif
                        </h4>
                        <form method="post" action="{{ route('admin.code.lists') }}">
                            @csrf
                            <div class="form-items-group">
                                <div class="form-group has-validation" style="margin-bottom: 0;">
                                    <select name="model_id" class="form-control @error('model_id') is-invalid @enderror"
                                        style="padding: 0.94rem 1.375rem!important; width: 200px;">
                                        <option value="">{{localize('Select Model')}}</option>
                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}" @selected($model->id == $modelId) >{{ $model->model_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('model_id')
                                        <small id="brand" class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group has-validation" style="margin-bottom: 0;">
                                    <input type="number" name="scanned_times" placeholder="Scanned Times" min="0"
                                        class="form-control @error('scanned_times') is-invalid @enderror"
                                        style="padding: 0.94rem 1.375rem!important; width: 140px;">
                                    @error('scanned_times')
                                        <small id="scanned_times" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-gradient-danger btn-sm me-2">{{localize('Apply Filters')}}</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="codeTable">
                            <thead>
                                <tr>
                                    <th> {{ localize("SL") }} </th>
                                    <th> {{ localize("QR Code Image") }} </th>
                                    <th> {{ localize("Store") }} </th>
                                    <th> {{ localize("Model") }} </th>
                                    <th> {{ localize("Retail Price") }} </th>
                                    <th> {{ localize("Security No") }}</th>
                                    <th> {{ localize("Total Scanned") }} </th>
                                    <th> {{ localize("Information") }} </th>
                                    <th> {{ localize("Created Date") }} </th>
                                    <th> {{ localize("Action") }} </th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($codes as $code)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <img src="{{ urlVersion($code->qr_path) }}" style="border-radius: 0" loading="lazy" alt="QR Code">
                                    </td>
                                    <td>
                                        @if($code->store)
                                            <span class="badge badge-success">
                                                {{ $code->store?->store_name ?: "*" }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                N/A
                                            </span>
                                        @endif
                                    </td>
                                    <td> {{ $code->model?->model_name }}</td>
                                    <td> {{ $code->model?->retail_price ?:0 }}</td>
                                    <td> {{ $code->security_no }}</td>
                                    <td> {{ $code->scanned }}</td>
                                    <td>
                                        @if ($code->informations->isNotEmpty())
                                            @php
                                                $latestInformation = $code->informations->last();
                                            @endphp

                                            <div class="alert alert-success">
                                                {{localize('IP:')}} {{ $latestInformation->ip }}, <br>
                                                {{localize('City:')}} {{ $latestInformation->cityName }}, <br>
                                                {{localize('Country:')}} {{ $latestInformation->countryName }} <br>
                                                {{localize('Current Time:')}} {{ $latestInformation->currentTime }}
                                            </div>
                                        @else

                                        @endif
                                    </td>
                                    <td>{{ showDateTime($code->created_at) }}</td>
                                    <td>
                                        {{-- <td>
                                            <button type="button" id="codeTable"
                                                class="btn btn-gradient-danger btn-icon btn-sm viewdetails"
                                                title="View Details" data-id='{{ $code->id }}'>
                                                <i class="mdi mdi-eye btn-icon-prepend"></i>
                                            </button>
                                        </td> --}}
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $codes->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.includes._viewModal')
@stop

@push('extra-scripts')

@endpush



@push('extra-styles')
    <style>
        .card-title-holder {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .card-title-holder .card-title {
            margin-bottom: 0px;
        }

        .table img.img-holder {
            border-radius: unset;
            width: 8mm;
            height: 8mm;
            box-sizing: border-box;
        }

        .update-section {
            border-radius: 3px;
            background: #f3f3f3;
            padding: 10px;
        }

        .update-section>p {
            font-size: 12px;
            line-height: 18px;
            font-weight: 600;
            color: #555;
            padding: 10px;
            background: #fff;
            border-radius: 3px;
        }

        .update-section span {
            font-weight: 700;
            color: #333;
        }

        .top-infos {
            display: flex;
            justify-content: flex-start;
            align-content: center;
        }

        .info-data {
            flex: 3;
        }

        .qr-holder {
            flex: 1;
            overflow: hidden;
            padding: 5px;
            background: #fff;
            border-radius: 3px;
            margin-right: 10px;
        }

        .qr-holder>img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .informations>h4 {
            margin-top: 20px;
            text-indent: 20px;
        }

        .form-group select option {
            padding: 0.94rem 1.375rem !important;
            font-size: 0.9125rem;
        }

        .form-items-group {
            display: flex;
            justify-content: end;
            align-content: center;
            gap: 10px;
        }
    </style>
@endpush
