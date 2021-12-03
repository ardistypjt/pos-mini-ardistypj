@if ($paginator->hasPages())
    <nav>
        <ul class="pagination" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" aria-hidden="true">&lsaquo;<i class="ki ki-bold-arrow-back icon-xs"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="btn btn-icon btn-sm btn-light-primary mr-2 my-1 page-link" href="javascript:;" wire:click="setPage('{{ $paginator->previousPageUrl() }}')" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;<i class="ki ki-bold-arrow-back icon-xs"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1 page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link btn btn-icon btn-sm border-0 btn-hover-primary  mr-2 my-1">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1 page-link" href="javascript:;" wire:click="setPage('{{ $url }}')">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" href="javascript:;" wire:click="setPage('{{ $paginator->nextPageUrl() }}')" rel="next" aria-label="@lang('pagination.next')">&rsaquo;<i class="ki ki-bold-arrow-next icon-xs"></i></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" aria-hidden="true">&rsaquo;<i class="ki ki-bold-arrow-next icon-xs"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
