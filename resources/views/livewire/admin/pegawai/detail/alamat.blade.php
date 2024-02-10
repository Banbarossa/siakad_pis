<table class="table table-sm">
    <div class="tbody">
        <tr>
            <td>Provinsi</td>
            <td>:</td>
            <th>{{ $pegawai->village ? $pegawai->village->district->regency->province->name:'' }}</th>
        </tr>
        <tr>
            <td>Kab/Kota</td>
            <td>:</td>
            <th>{{ $pegawai->village ? $pegawai->village->district->regency->name:'' }}</th>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <th>{{ $pegawai->village ? $pegawai->village->district->name:'' }}</th>
        </tr>
        <tr>
            <td>Desa</td>
            <td>:</td>
            <th>{{ $pegawai->village ? ucFirst($pegawai->village->name):'' }}</th>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <th>{{ $pegawai->alamat }}</th>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>:</td>
            <th>{{ $pegawai->kode_pos }}</th>
        </tr>
        @if ($pegawai->status_nikah != 1)
        <tr>
            <td colspan="3" class="fs-3"><i class="fas fa-child mr-2"></i><strong>Anak</strong></td>
        </tr>
        <tr>
            <td>Jumlah Anak</td>
            <td>:</td>
            <th><button class="btn btn-sm btn-outline-primary" wire:click='changeLevel({{3}})'><i class="fas fa-list mr-3"></i>{{ $pegawai->anakpegawai->count() }}</button></th>
        </tr>
        @endif
    </div>
</table>