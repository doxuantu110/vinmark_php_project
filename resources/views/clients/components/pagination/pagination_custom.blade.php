@if ($paginator->hasPages())
    <ul class="ltn__pagination justify-content-center">

        {{-- Trang trước --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span><i class="fas fa-angle-double-left"></i></span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link">
                    <i class="fas fa-angle-double-left"></i>
                </a>
            </li>
        @endif

        {{-- Các trang --}}
        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled">
                    <span>{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <span>{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Trang sau --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link">
                    <i class="fas fa-angle-double-right"></i>
                </a>
            </li>
        @else
            <li class="disabled">
                <span><i class="fas fa-angle-double-right"></i></span>
            </li>
        @endif

    </ul>
@endif
