<div class="table-responsive">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Anak Ke</th>
                <th>NIK</th>
                <th>Tempat lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pendidikan</th>
                <th>Action</th>
            </tr>
        </thead>
    
        <tbody>
            @forelse ($pegawai->anakpegawai as $item)
                <tr>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->anak_ke}}</td>
                    <td>{{$item->nik}}</td>
                    <td>{{$item->tempat_lahir}}</td>
                    <td>{{$item->tanggal_lahir}}</td>
                    <td>{{ucFirst($item->jenis_kelamin)}}</td>
                    <td>{{$item->pendidikan}}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning" wire:click='editAnak({{ $item->id }})' data-toggle="modal" data-target="#modal-edit-anak"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger" wire:confirm='Apakah yakin untuk menghapus data {{ $item->nama }}' wire:click='destroyAnak({{ $item->id }})'><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak Ada Data Ditemukan</td>
                </tr>
                
            @endforelse
            <tr></tr>
        </tbody>
    </table>

</div>