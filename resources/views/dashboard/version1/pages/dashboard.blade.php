@extends('dashboard.version1.layouts.main')

@section('title', localize(' - Home'))


@section('content')
    <div class="row">
        @if(user()->user_type == 'admin')
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{localize('Total Orders')}} <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $orderCounts->total_orders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{localize('Last 30 Day\'s Orders')}} <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $orderCounts->last_30_days_orders }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                            alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">{{localize('Today\'s Orders')}} <i
                                class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $orderCounts->today_orders }}</h2>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order Date</th>
                                    <th>Total Messages</th>
                                    <th>Amount</th>
                                    <th>User Email</th>
                                    <th>Target Email</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $key=>$order)
                                    @php
                                        $fromEmail = explode("@", $order->from_email);
                                        $recipient_email = explode("@", $order->recipient_email);
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->total_messages }}</td>
                                        <td>£ {{ $order->paid_amount }}</td>
                                        <td>{{ substr($fromEmail[0],0,2)."******@*****" }}</td>
                                        <td>{{ substr($recipient_email[0],0,2)."******@*****" }}</td>
                                        <td>
                                            @if($order->is_paid == 1)
                                                <strong class="bg-success text-white p-1 border-rounded text-center">Paid</strong>
                                            @else
                                                <strong class="bg-danger text-white p-1 border-rounded text-center">Unpaid</strong>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>

                        {{ $orders->count() > 0 ? $orders->links() : null }}
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
