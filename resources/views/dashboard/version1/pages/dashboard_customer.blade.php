@extends('dashboard.layouts.main')

@section('title', localize(' - Home'))
@section('top-header', localize('Welcome to '))


@section('content')
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                         alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Total QRCodes')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                         alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Scanned QRCodes')}} <i
                            class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">0</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                         alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Scanned QRCodes (Multiple)')}} <i
                            class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{localize('0')}}</h2>
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
