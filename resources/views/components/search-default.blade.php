<div class="d-flex justify-content-end">
    <div class="input-group input-group-sm" style="width: 200px">
        <input type="text" wire:model.live.debounce.100ms="search" class="form-control"
            placeholder="Search">
        <div class="input-group-append">
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>