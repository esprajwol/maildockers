@extends('dashboard.version1.layouts.main')
@section('content')
    @if(user()->user_type == 'admin')
        <div class="row">
            <x-dashboard.chart-card label="Total Earnings of : {{ now()->format('Y') }}"
                                    :amount="$currentYearBenchMarkWithOrderTotal[0]"
                                    :benchMark="$currentYearBenchMarkWithOrderTotal[2]"
                                    chartId="runningYear"/>

            <x-dashboard.chart-card label="Total Orders"
                                    :amount="$orderCounts->total_orders"
                                    :benchMark="$lastYearBenchMark"
                                    chartId="chart1"/>

            <x-dashboard.chart-card label="This Month Orders"
                                    :amount="$chartOrders->sum('orders')"
                                    :benchMark="$lastMonthBenchMark"
                                    chartId="chart2"/>

            <x-dashboard.chart-card label="Today's Orders"
                                    :amount="$hourlyTotalOrder"
                                    chartId="hourlyChart"/>

            <x-dashboard.chart-card label="This Week Order"
                                    :amount="$lastWeekOrder->count()"
                                    :benchMark="$weekBenchMark"
                                    chartId="chart7Days"/>
        </div>

        <!-- <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <span class="text-fixed-white fs-11">{{localize('Total Orders')}}</span>
                                <h4 class="text-fixed-white mb-0">{{ $orderCounts->total_orders }}<span
                                        class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i
                                            class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span>
                                </h4>
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                   class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="new-issues"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <span class="text-fixed-white fs-11">{{localize('Last 30 Day\'s Orders')}} </span>
                                <h4 class="text-fixed-white mb-0">{{ $orderCounts->last_30_days_orders }}<span
                                        class="text-danger fs-12 ms-2 fw-semibold"><i
                                            class="ti ti-trending-down align-middle me-1 d-inline-block"></i>0.25%</span>
                                </h4>
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                   class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="completed-issues"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <span class="text-fixed-white fs-11">{{localize('Today\'s Orders')}}</span>
                                <h4 class="text-fixed-white mb-0">{{ $orderCounts->today_orders }}<span
                                        class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i
                                            class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span>
                                </h4>
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                   class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="pending-issues"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card custom-card">
                    <div class="top-left"></div>
                    <div class="top-right"></div>
                    <div class="bottom-left"></div>
                    <div class="bottom-right"></div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-start justify-content-between">
                            <div>
                                <span class="text-fixed-white fs-11">...</span>
                                <h4 class="text-fixed-white mb-0">00<span
                                        class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i
                                            class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span>
                                </h4>
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown"
                                   class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="unresolved-issues"></div>
                    </div>
                </div>
            </div>
        </div> -->
    @endif
    <!-- Start:: row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="top-left"></div>
                <div class="top-right"></div>
                <div class="bottom-left"></div>
                <div class="bottom-right"></div>
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Recent Order
                    </div>
                    <div class="prism-toggle">
{{--                        <button class="btn btn-sm btn-primary-light">Show Code<i--}}
{{--                                class="ri-code-line ms-2 d-inline-block align-middle"></i></button>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Total Message</th>
                                <th scope="col">Amount</th>
                                <th scope="col">User Email</th>
                                <th scope="col">Target Email</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($adminOrders as $key=>$order)
                                @php
                                    $fromEmail = explode("@", $order->from_email);
                                    $recipient_email = explode("@", $order->recipient_email);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->total_messages }}</td>
                                    <td>£ {{ $order->paid_amount }}</td>
                                    <td>{{ substr($fromEmail[0],0,2)."******@*****" }}</td>
                                    <td>{{ substr($recipient_email[0],0,2)."******@*****" }}</td>
                                    <td>
                                        @if($order->is_paid == 1)
                                            <span class="badge bg-outline-success">Paid</span>
                                        @else
                                            <span class="badge bg-outline-warning">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                            </tbody>
                        </table>
                        <div class="text-center mt-2" style="float:right">
                            {{ $adminOrders->count() > 0 ? $adminOrders->links() : null }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: row-1 -->
@endsection


@push('extra-scripts')
    <!-- jQuery -->
    @include("dashboard.version1.dashboard.js")
    @include("dashboard.chart.chart-js")
    @include("dashboard.version1.dashboard.chart.dashboard_running_year_chart_js")
    @include("dashboard.version1.dashboard.chart.dashboard_total_orders_js")
    @include("dashboard.version1.dashboard.chart.dashboard_hour_chart_js")
    @include("dashboard.version1.dashboard.chart.dashboard_7_days_chart_js")
@endpush
