@extends('dashboard.version1.layouts.main')

@section('title', localize('Localizations'))
@section('top-header', localize('Localizations'))

@section('content')

    <div class="row">
        <div class="col-xl-6">
            <h2>Coupons List</h2>
        </div>
        <div class="col-xl-4"></div>
        <div class="col-xl-2">
            <a class="btn btn-primary" href="{{ route('admin.coupons.create') }}">Generate New Coupon</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Used By</th>
                                <th>Used At</th>
                            </tr>
                        </thead>
                        <tbody class="add_new_row">
                            @foreach ($coupons as $coupon)
                                <tr>

                                    <td> <span class="badge bg-info text-lite fw-bold"
                                            style="font-size:15px; padding-top: 7px">{{ $coupon->coupon_no }}</span> </td>
                                    <td>
                                        @if ($coupon->used_at)
                                            <span class='badge bg-warning'>Used</span>
                                        @else
                                            <span class='badge bg-success'>New</span>
                                        @endif
                                    </td>
                                    <td>{{ $coupon->created_at }}</td>
                                    <td>
                                        @if ($coupon->email)
                                            {{ $coupon->email }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon->used_at)
                                            {{ $coupon->used_at }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $coupons->links() }}
@endsection

@section('js')

@endsection
