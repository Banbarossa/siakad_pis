<table class="table table-sm">
    <div class="tbody">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->nama_istri:'' }}</th>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->nik_istri:'' }}</th>
        </tr>
        <tr>
            <td>Tempat lahir</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->tempat_lahir_istri:'' }}</th>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->tanggal_lahir_istri:'' }}</th>
        </tr>
        <tr>
            <td>Pendidikan</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->pendidikan_istri:'' }}</th>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <th>{{ $pegawai->istripegawai ? $pegawai->istripegawai->pekerjaan_istri:'' }}</th>
        </tr>
    </div>
</table>