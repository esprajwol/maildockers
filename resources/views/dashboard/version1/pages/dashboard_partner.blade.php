@extends('dashboard.version1.layouts.main')

@section('title', dashboardPrefix())
@section('top-header', localize('Welcome to Partner Dashboard'))


@section('content')
    <div class="row">
        <div class="row">
            {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="text-fixed-white mb-0">{{ localize('Total Registrations') }}</h4>
                                <span class="text-fixed-white fs-11">{{$dateRange}} {{$countryCode}}</span>
                                <h4 class="text-fixed-white mb-0">
                                    {{ number_format($grandDataOfAllYears['totalUniqueRegistrants']) }}

                                </h4>

                                <p>
                                    @if ($registrantBenchMarkFromLastMonth < 0)
                                        <span class="text-danger fs-12 ms-2 fw-semibold">
                                            <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                            {{ number_format($registrantBenchMarkFromLastMonth * -1, 2) }}% from
                                            last month
                                        </span>
                                    @else
                                        <span class="text-success fs-12 fw-semibold d-inline-block">
                                            <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                            {{ number_format($registrantBenchMarkFromLastMonth, 2) }}% from
                                            last month
                                        </span>
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="text-fixed-white mb-0">{{ localize('Total Documents') }} </h4>
                                <span class="text-fixed-white fs-11">{{$dateRange}} {{$countryCode}}</span>
                                <h4 class="text-fixed-white mb-0">
                                    {{ number_format($grandDataOfAllYears['grandTotalOrders']) }}

                                </h4>

                                <p>
                                    @if ($documentBenchMarkFromLastMonth < 0)
                                        <span class="text-danger fs-12 ms-2 fw-semibold">
                                            <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                            {{ number_format($documentBenchMarkFromLastMonth * -1, 2) }}% from
                                            last month
                                        </span>
                                    @else
                                        <span class="text-success fs-12 fw-semibold d-inline-block">
                                            <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                            {{ number_format($documentBenchMarkFromLastMonth, 2) }}% from
                                            last month
                                        </span>
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="text-fixed-white mb-0">{{ localize('Total Correspondences') }}</h4>
                                <span class="text-fixed-white fs-11">{{$dateRange}} {{$countryCode}}</span>
                                <h4 class="text-fixed-white mb-0">
                                    {{ number_format($grandDataOfAllYears['grandTotalCorrespondences']) }}
                                </h4>
                                <p>
                                    @if ($correspondenceBenchMarkFromLastMonth < 0)
                                        <span class="text-danger fs-12 ms-2 fw-semibold">
                                            <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                            {{ number_format($correspondenceBenchMarkFromLastMonth * -1, 2) }}% from
                                            last month
                                        </span>
                                    @else
                                        <span class="text-success fs-12 fw-semibold d-inline-block">
                                            <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                            {{ number_format($correspondenceBenchMarkFromLastMonth, 2) }}% from
                                            last month
                                        </span>
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div><h4 class="text-fixed-white mb-0">{{ localize('Total Income') }}</h4>
                                <span class="text-fixed-white fs-11">{{$dateRange}} {{$countryCode}}</span>
                                <h4 class="text-fixed-white mb-0">
                                    {{ number_format($grandDataOfAllYears['grandTotalEarnings']) }}

                                </h4>

                                <p>
                                    @if ($incomeBenchMarkFromLastMonth < 0)
                                        <span class="text-danger fs-12 ms-2 fw-semibold">
                                            <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                            {{ number_format($incomeBenchMarkFromLastMonth * -1, 2) }}% from
                                            last month
                                        </span>
                                    @else
                                        <span class="text-success fs-12 fw-semibold d-inline-block">
                                            <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                            {{ number_format($incomeBenchMarkFromLastMonth, 2) }}% from
                                            last month
                                        </span>
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div> --}}
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

@push('extra-scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            // Function to scroll to a specific element or position
            @if (isset($_GET['start_date']))
                scrollToPosition();
            @endif
        });

        function scrollToPosition() {
            $('html, body').animate({
                scrollTop: $(document).height() - $(window).height()
            }, 1000);
        }
    </script>

    <!-- jQuery -->
    {{-- @include('dashboard.version1.dashboard.js')
    @include('dashboard.chart.chart-js') --}}
    {{--    @include("dashboard.version1.dashboard.chart.dashboard_running_year_chart_js") --}}
    {{-- @include('dashboard.version1.dashboard.chart.dashboard_total_orders_js')
    @include('dashboard.version1.dashboard.chart.dashboard_running_month_js')
    @include('dashboard.version1.dashboard.chart.dashboard_hour_chart_js')
    @include('dashboard.version1.dashboard.chart.dashboard_7_days_chart_js')
    @include('dashboard.version1.dashboard.chart.dashboard_return_customer_chart') --}}
@endpush
