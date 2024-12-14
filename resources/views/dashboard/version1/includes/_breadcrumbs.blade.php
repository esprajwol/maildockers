<div class="page-header">
    <h3 class="page-title text-capitalize">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span>
        @yield("top-header")
        @yield("top_header")
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($segments = request()->segments() as $index => $segment)
                @if(!$index == 0)
                <li class="breadcrumb-item text-capitalize" aria-current="page">{{ $segment }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
