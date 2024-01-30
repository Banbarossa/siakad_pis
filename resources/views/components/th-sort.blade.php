@props(['label','name','sortColumn','sortDirection'])

<th wire:click='sortTable("{{$name}}")' >
    <div class="d-flex justify-content-between align-items-center">
        {{$label}}
        @if ($sortColumn == $name)
        <span class="">
            <i class="fas fa-caret-{{$name == $sortColumn && $sortDirection == "desc" ? 'up':'down'}} fa-fw"></i>
        </span>
        @else
            <i class="fas fa-sort fa-xs text-muted ml-3"></i>
        @endif
    </div>
</th>