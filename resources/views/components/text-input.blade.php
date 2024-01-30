@props(['disabled' => false,'messages', 'label', 'name','label','id','type'=>'text'] )

<div class="form-group">
    <label for="{{$id}}">{{$label}}</label>
    <input type="{{$type}}" id="{{$id}}" name="{{$name}}" class="form-control form-control @if($messages) is-invalid @endif">
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