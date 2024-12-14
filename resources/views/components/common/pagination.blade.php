@props([
    "items"
])


<nav class="d-flex justify-items-center justify-content-between">
    <div class="d-flex justify-content-between flex-fill d-sm-none">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($items->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">« Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $items->previousPageUrl() }}" rel="prev">« Previous</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($items->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $items->nextPageUrl() }}" rel="next">Next »</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Next »</span>
                </li>
            @endif
        </ul>
    </div>

    <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
        <div>
            <p class="small text-muted">
                Showing
                <span class="fw-semibold">{{ $items->firstItem() }}</span>
                to
                <span class="fw-semibold">{{ $items->lastItem() }}</span>
                of
                <span class="fw-semibold">{{ $items->total() }}</span>
                results
            </p>
        </div>

        <div>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($items->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                        <span class="page-link" aria-hidden="true">‹</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $items->previousPageUrl() }}" rel="prev" aria-label="« Previous">‹</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($items->links()->elements[0] as $page => $url)
                    @if ($page == $items->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($items->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $items->nextPageUrl() }}" rel="next" aria-label="Next »">›</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="Next »">
                        <span class="page-link" aria-hidden="true">›</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
