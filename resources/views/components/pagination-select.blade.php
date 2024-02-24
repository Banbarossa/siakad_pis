@props(['model'=>'perPage'])
<div class="form-group">
    <label class="font-weight-normal">perpage</label>
    <select class="custom-select custom-select-sm" wire:model.live='{{$model}}' style="width: 60px">
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>