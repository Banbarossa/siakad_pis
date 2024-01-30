<table class="table table-sm">
    <div class="tbody">
        <tr>
            <td>Hobi</td>
            <td>:</td>
            <th>{{ $student->hobi }}</th>
        </tr>
        <tr>
            <td>Cita Cita</td>
            <td>:</td>
            <th>{{ $student->cita_cita }}</th>
        </tr>
        <tr>
            <td>Tinggi Badan</td>
            <td>:</td>
            <th>{{ $student->tinggi_badan }}</th>
        </tr>
        <tr>
            <td>Hobi</td>
            <td>:</td>
            <th>{{ $student->berat_badan }}</th>
        </tr>
        <tr>
            <td>Golongan Darah</td>
            <td>:</td>
            <th>{{ $student->golongan_darah }}</th>
        </tr>
        <tr>
            <td colspan="3"><i class="fas fa-map-marker-alt mr-2"></i><strong>Alamat</strong></td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>:</td>
            <th>{{ $student->village ? $student->village->district->regency->province->name:'' }}</th>
        </tr>
        <tr>
            <td>Kab/Kota</td>
            <td>:</td>
            <th>{{ $student->village ? $student->village->district->regency->name:'' }}</th>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <th>{{ $student->village ? $student->village->district->name:'' }}</th>
        </tr>
        <tr>
            <td>Desa</td>
            <td>:</td>
            <th>{{ $student->village ? ucFirst($student->village->name):'' }}</th>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <th>{{ $student->alamat }}</th>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>:</td>
            <th>{{ $student->kode_pos }}</th>
        </tr>
        @if ($student->status_sosial=='yatim')
        <tr>
            <td colspan="3"> <i class="fas fa-donate mr-2"></i><strong>Donatur Yatim</strong></td>
        </tr>
        <tr>
            <td>Nama Wali</td>
            <td>:</td>
            <th>{{ $student->nama_wali }}</th>
        </tr>
        <tr>
            <td>Nomor Yatim</td>
            <td>:</td>
            <th>{{ $student->nomor_yatim }}</th>
        </tr>
        <tr>
            <td>Nomor Wali</td>
            <td>:</td>
            <th>{{ $student->nomor_wali }}</th>
        </tr>
        <tr>
        @endif
    </div>
</table>