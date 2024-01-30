<div class="table-responsive ">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Email</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            
            @if ($akun)
                @foreach ($akun as $item)
                <tr>
                    <td>{{$item->email}}</td>
                    <td>{{ strToUpper($item->pivot->type)}}</td>
                </tr>
                    
                @endforeach
            
            @else
                Belum ada data ayah yang ditemukan
            @endif
            
        </tbody>
    </table>
</div>