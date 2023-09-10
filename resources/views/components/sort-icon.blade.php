@props(['sortBy', 'asc', 'sortField'])

@if ($sortBy == $sortField)
    @if ($asc)
        <i class="fa-solid fa-sort-up" ></i>
    @endif
    @if(!$asc)
        <i class="fa-solid fa-sort-down"></i>
    @endif
@endif
