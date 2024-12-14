@props([
    "label" => "Total Orders",
    "amount" => null,
    "benchMark" => null,
    "chartId" => null,
    "divClass" => "col-xl-6 col-lg-6 col-md-6 col-sm-6"
])

<div class="{{ $divClass }} col-12">
    <div class="card custom-card">
        <div class="top-left"></div>
        <div class="top-right"></div>
        <div class="bottom-left"></div>
        <div class="bottom-right"></div>
        <div class="card-body">
            <div class="mb-3 d-flex align-items-start justify-content-between">
                <div>
                    <span class="text-fixed-white fs-11">{{localize($label)}} </span>
                    <h4 class="text-fixed-white mb-0">
                        @if(!is_null($amount))
                            {{ $amount }}
                        @endif

                        @if(!is_null($benchMark))
                            {!! bench_mark($benchMark) !!}
                        @endif
                    </h4>
                </div>
            </div>
            @isset($chartId)
                <div id="{{ $chartId }}"></div>
            @endisset
        </div>
    </div>
</div>
