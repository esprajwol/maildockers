@extends('dashboard.version1.layouts.main')

@section('title', localize('Localizations'))
@section('top-header', localize('Localizations'))

@section('content')
    <h2>Used Coupons</h2>
    <hr>

    <div class="row g-3 mb-3">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Coupon No</th>
                            <th>Email</th>
                            <th>Used At</th>
                            <th>Created Date</th>
                        </tr>
                        </thead>
                        <tbody class="add_new_row">
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupon->coupon_no }} </td>
                                    <td>{{ $coupon->email }}  </td>
                                    <td>{{ $coupon->used_at }}  </td>
                                    <td>{{ $coupon->created_at }}</td>
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

@section("js")

@endsection
