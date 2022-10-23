@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        <li class="page-item page-nav {{ $paginator->onFirstPage() ? ' disabled' : '' }}" onclick="pagination_prev()" aria-disabled="true" id="prev-page" aria-label="@lang('pagination.previous')">
           <a class="page-link" href="javascript:void(0)" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if(is_array($element))
                @foreach ($element as $page => $url)
                <li class="page-item page-item-number {{$page == $paginator->currentPage() ? 'active' : ''}}" value="{{$page}}" aria-current="page" onclick="pagination_item({{$page}})"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                @endforeach
            @endif
        @endforeach
        <li class="page-item page-nav {{ $paginator->hasMorePages() ? '' : ' disabled' }}" onclick="pagination_next()" id="next-page" aria-disabled="true" aria-label="@lang('pagination.next')">
            <a  class="page-link" href="javascript:void(0)" aria-hidden="true">&rsaquo;</a>
        </li>
    </ul>
</nav>
<div>
    <?php 
    $splitPaginator = explode(' ',count($paginator));
    ?>
    <span id="pagination-count">{{(count($paginator))}}</span> out of 
</div>
@endif
