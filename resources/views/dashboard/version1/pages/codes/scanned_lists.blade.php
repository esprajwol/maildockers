@extends('dashboard.layouts.main')

@section('title', ' - Code Lists')

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

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                @if (Helper::is_super_admin())
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active btn-gradient-primary" aria-current="page" href="#">Scanned QR
                                    Codes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary" href="{{ route('admin.code.lists') }}">All QR Codes</a>
                            </li>
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <div class="card-title-holder">
                        <h4 class="card-title">{{localize('Scanned QR Codes')}}</h4>
                        <div>
                            @if (Helper::is_super_admin())
                                <a href="{{ route('admin.code.generate.each') }}"
                                    class="btn btn-gradient-primary btn-icon-text btn-sm">
                                    <i class="mdi mdi-plus btn-icon-prepend"></i> {{localize('Add New Code')}}
                                </a>
                                <a href="{{ route('admin.code.export', ['brandId' => $brandId ?? null]) }}"
                                    class="btn btn-gradient-danger btn-icon-text btn-sm">
                                    <i class="mdi mdi-upload btn-icon-prepend"></i> {{localize('Export Data')}}
                                </a>
                            @endif
                            {{-- <a href="{{ route('admin.code.generate') }}"
                            class="btn btn-gradient-primary btn-icon-text btn-sm">
                            <i class="mdi mdi-plus btn-icon-prepend"></i> Bulk Import
                        </a> --}}

                            @if ($brandId)
                                <a href="{{ route('admin.code.zip.download', $brandId) }}"
                                    class="btn btn-gradient-success btn-icon-text btn-sm">
                                    <i class="mdi mdi-download btn-icon-prepend"></i> {{localize('Download .zip')}}
                                </a>
                            @endif
                        </div>

                    </div>
                    <hr>

                    <div class="card-title-holder">
                        <h4 class="card-title">{{localize('Filter by Brand:')}} @if ($brandId)
                                @if (count($codes))
                                    {{ $codes[0]->brand->name }}
                                @else
                                    {{localize('N/A')}}
                                @endif
                            @else
                                {{localize('All')}}
                            @endif
                        </h4>
                        <form method="post" action="{{ route('admin.code.scanned.lists') }}">
                            @csrf
                            <div class="form-items-group">
                                <div class="form-group has-validation" style="margin-bottom: 0;">
                                    <select name="brand" class="form-control @error('brand') is-invalid @enderror"
                                        style="padding: 0.94rem 1.375rem!important; width: 200px;">
                                        <option value="">{{localize('Select Brand')}}</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <small id="brand" class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group has-validation" style="margin-bottom: 0;">
                                    <input type="number" name="scanned_times" placeholder="Scanned Times" min="1"
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
                                    <th> {{localize('ID')}} </th>
                                    <th> {{localize('Product of.')}} </th>
                                    <th> {{localize('Security No.')}} </th>
                                    <th> {{localize('Scanned No.')}} </th>
                                    <th> {{localize('Location')}} </th>
                                    <th> {{localize('Date')}} </th>
                                    <th> {{localize('Status')}} </th>
                                    <th> {{localize('Action')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($codes as $code)
                                    <tr>
                                        <td> {{ $code->id }} </td>
                                        <td> {{ $code->brand->name }} </td>
                                        <td> {{ $code->security_no }} </td>
                                        <td> {{ $code->scanned }} </td>
                                        @if ($code->informations->first() !== null)
                                            <td> {{ $code->informations->first()->cityName, $code->informations->first()->countryName }}
                                            </td>
                                            <td> {{ $code->informations->first()->currentTime }} </td>
                                        @else
                                            <td> </td>
                                            <td> </td>
                                        @endif
                                        <td>
                                            <label
                                                class="badge {{ $code->scanned < 1 ? 'badge-gradient-primary' : ($code->scanned == 1 ? 'badge-gradient-success' : 'badge-gradient-danger') }}">{{ $code->scanned < 1 ? 'Not Scanned' : ($code->scanned == 1 ? 'Correct Scanned' : 'Repeat Scanned') }}</label>
                                        </td>
                                        <td>
                                            <button type="button" id="codeTable"
                                                class="btn btn-gradient-danger btn-icon btn-sm viewdetails"
                                                title="View Details" data-id='{{ $code->id }}'>
                                                <i class="mdi mdi-eye btn-icon-prepend"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @include('dashboard.includes._viewModal')
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
@stop

@push('extra-scripts')
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#codeTable').on('click', '.viewdetails', function() {

                var codeId = $(this).attr('data-id');
                if (codeId > 0) {

                    // AJAX request
                    var url = "{{ route('admin.code.show', [':codeId']) }}";
                    url = url.replace(':codeId', codeId);

                    // Empty modal data
                    $('#viewData').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#viewData').html(response.html);

                            // Display Modal
                            $('#viewModal').modal('show');
                        }
                    });
                }
            });

        });
    </script>
@endpush
