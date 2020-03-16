<div class="pagination">

    @if ($paginator->lastPage() > 1)
        @if ($paginator->currentPage() != 1)
            <a class="pagination__arrow pagination__arrow--prev" href="{{ $paginator->previousPageUrl() }}">
                <span></span>
            </a>
            <a class="pagination__item pagination__item--first" href="">
                1
            </a>
        @endif

        <div class="pagination__omit">
            <span></span>
        </div>

        @if ($paginator->currentPage() - 2 > 1)
            <a class="pagination__item" href="{{ $paginator->url($paginator->currentPage() - 2) }}">
                {{ $paginator->currentPage() - 2 }}
            </a>
        @endif
        @if ($paginator->currentPage() - 1 > 1)
            <a class="pagination__item" href="{{ $paginator->url($paginator->currentPage() - 1) }}">
                {{ $paginator->currentPage() - 1 }}
            </a>
        @endif

        <div class="pagination__item pagination__item--current">{{ $paginator->currentPage() }}</div>

        @if ($paginator->currentPage() + 1 < $paginator->lastPage())
            <a class="pagination__item" href="{{ $paginator->url($paginator->currentPage() + 1) }}">
                {{ $paginator->currentPage() + 1 }}
            </a>
        @endif
        @if ($paginator->currentPage() + 2 < $paginator->lastPage())
            <a class="pagination__item" href="{{ $paginator->url($paginator->currentPage() + 2) }}">
                {{ $paginator->currentPage() + 2 }}
            </a>
        @endif

        <div class="pagination__omit">
            <span></span>
        </div>

        @if ($paginator->lastPage() != $paginator->currentPage())
            <a class="pagination__item pagination__item--last" href="{{ $paginator->url($paginator->lastPage()) }}">
                {{ $paginator->lastPage() }}
            </a>
            <a class="pagination__arrow pagination__arrow--next" href="{{ $paginator->nextPageUrl() }}">
                <span></span>
            </a>
        @endif

    @else
        {{-- non pagination --}}
        {{-- TODO: ページーネーションが存在しない場合のデザインを確認する --}}
        <div class="pagination__item pagination__item--current">1</div>
    @endif
</div>
