@props(['disabled' => false,'messages', 'label', 'model','label','id','type'=>'text'] )

<div class="form-group">
    <label for="{{$id}}" class="text-muted font-weight-normal">{{$label}}</label>
    <input type="{{$type}}" id="{{$id}}" wire:model="{{$model}}" {{$attributes->merge(['class'=>'form-control'])}}>

    @if($messages)
        <div class="invalid-feedback">
            <ul>
                @foreach ($messages as $item)
                <li>{{$item}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>