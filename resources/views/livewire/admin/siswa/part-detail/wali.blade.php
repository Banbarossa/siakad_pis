<div class="table-responsive ">
    <table class="table table-sm">
        <tbody>
            @if ($wali)
            <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{ $wali->nama }}</th>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <th>{{ $wali->nik }}</th>
            </tr>
            <tr>
                <td>Tempat, Tgl. Lahir</td>
                <td>:</td>
                <th>{{ $wali->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($wali->tanggal_lahir)->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <th>{{ $wali->pendidikan }}</th>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <th>{{ $wali->pekerjaan }}</th>
            </tr>
            <tr>
                <td>Penghasilan</td>
                <td>:</td>
                <th>{{ $wali->penghasilan }}</th>
            </tr>
            <tr>
                <td>No Contact</td>
                <td>:</td>
                <th>{{ $wali->contact }}</th>
            </tr>
            <tr>
                <td>Province</td>
                <td>:</td>
                <th>{{ $wali->village ? $wali->village->district->regency->province->name:'' }}</th>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <th>{{ $wali->village ? $wali->village->district->regency->name:'' }}</th>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <th>{{ $wali->village ? $wali->village->district->name:'' }}</th>
            </tr>
            <tr>
                <td>Desa/Kelurahan</td>
                <td>:</td>
                <th>{{ $wali->village ? $wali->village->name:'' }}</th>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <th>{{ $wali->alamat }}</th>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <th>{{ $wali->kode_pos }}</th>
            </tr>
            @else
                Belum ada data ayah yang ditemukan
            @endif
            
        </tbody>
    </table>
</div>