<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.includes._head')
</head>
<body>
<div class="container-scroller">
    <!-- include:includes/_navbar -->
    @include('dashboard.includes._navigation')
    <!-- include -->
    <div class="container-fluid page-body-wrapper">
        <!-- include:includes/_sidebar -->

        @if(isAdmin())
            @include('dashboard.includes._sidebar')
        @endif

        @if(isCustomer())
            @include('dashboard.includes._sidebar_customer')
        @endif

        @if(isPartner())
            @include('dashboard.includes._sidebar_partner')
        @endif

        <!-- include -->
        <div class="main-panel">
            <div class="content-wrapper">
                @include('dashboard.includes._breadcrumbs')

                <!-- Actions section where the form should appear -->
                <div class="actions">
                    @yield('actions')
                </div>

                {{-- Showing User Current Status Start --}}
                @if(!isActiveUser() && !request()->has('stripeSuccess'))
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h1 class="text-danger">
                                        {{  localize("Your current status is : inactive. Please, contact with admin") }}
                                    </h1>
                                    <a
                                        class="btn btn-success"
                                        href="{{ url('/') }}">
                                        {{ localize("Back to Website") }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @yield('content')
                @endif
                {{-- Showing User Current Status End --}}
            </div>
            <!-- content-wrapper ends -->
            <!-- include:includes/_footer -->
            @include('dashboard.includes._footer')
            <!-- include -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- include:includes/_script -->
@include('dashboard.includes._script')
<!-- include -->

{{-- Write a common modal html code here--}}
<div class="modal fade"
     id="imgCommonModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{localize('Model Image')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="showImage" style="overflow: hidden; margin: auto; text-align: center">
                    <img src="" class="modalImg"
                         loading="lazy"

                         alt=""
                    >
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
