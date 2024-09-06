<nav class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination" data-animate="fadeInUp">
    <ul  class="pagination m-0 ">
        @if ($paginator->onFirstPage())
            <li style="padding-right: 10px" class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded-circle d-flex align-items-center justify-content-center" aria-label="Previous">
                    <svg class="icon">
                        <use xlink:href="#icon-angle-double-left"></use>
                    </svg>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link rounded-circle d-flex align-items-center justify-content-center" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <svg class="icon">
                        <use xlink:href="#icon-angle-double-left"></use>
                    </svg>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <li style="padding-right: 10px" class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item " style="padding-right: 10px">
                <a class="page-link rounded-circle d-flex align-items-center justify-content-center " href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <svg class="icon">
                        <use xlink:href="#icon-angle-double-right"></use>
                    </svg>
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link rounded-circle d-flex align-items-center justify-content-center" aria-label="Next">
                    <svg class="icon">
                        <use xlink:href="#icon-angle-double-right"></use>
                    </svg>
                </span>
            </li>
        @endif
    </ul>
</nav>
