@if ($paginator->hasPages())
    <nav class="agrivall-pagination">
        {{-- Enlace Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="agrivall-pag-btn disabled">
                <i class="fa-solid fa-chevron-left me-1"></i> Anterior
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="agrivall-pag-btn">
                <i class="fa-solid fa-chevron-left me-1"></i> Anterior
            </a>
        @endif

        {{-- Números de página directos --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="agrivall-pag-dot">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="agrivall-pag-num active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="agrivall-pag-num">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Enlace Siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="agrivall-pag-btn">
                Siguiente <i class="fa-solid fa-chevron-right ms-1"></i>
            </a>
        @else
            <span class="agrivall-pag-btn disabled">
                Siguiente <i class="fa-solid fa-chevron-right ms-1"></i>
            </span>
        @endif
    </nav>
@endif
