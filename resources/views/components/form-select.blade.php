@props(['options', 'label','id','model','messages'])

<div class="form-group">
    <label for="{{$id}}">{{$label}}</label>
    <select wire:model='{{$model}}' id="{{$id}}" {{ $attributes->merge(['class' => 'form-control']) }}>
        <option value="">Pilih</option>
        @foreach($options as  $value)
            <option value="{{ $value }}">{{$value}}</option>
        @endforeach
    </select>
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