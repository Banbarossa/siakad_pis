<div class="table-responsive ">
    <table class="table table-sm">
        <tbody>
            @if ($ibu)
            <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{ $ibu->nama }}</th>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <th>{{ $ibu->nik }}</th>
            </tr>
            <tr>
                <td>Tempat, Tgl. Lahir</td>
                <td>:</td>
                <th>{{ $ibu->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($ibu->tanggal_lahir)->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <th>{{ $ibu->pendidikan }}</th>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <th>{{ $ibu->pekerjaan }}</th>
            </tr>
            <tr>
                <td>Penghasilan</td>
                <td>:</td>
                <th>{{ $ibu->penghasilan }}</th>
            </tr>
            <tr>
                <td>No Contact</td>
                <td>:</td>
                <th>{{ $ibu->contact }}</th>
            </tr>
            <tr>
                <td>Province</td>
                <td>:</td>
                <th>{{ $ibu->village ? $ibu->village->district->regency->province->name:'' }}</th>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <th>{{ $ibu->village ? $ibu->village->district->regency->name:'' }}</th>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <th>{{ $ibu->village ? $ibu->village->district->name:'' }}</th>
            </tr>
            <tr>
                <td>Desa/Kelurahan</td>
                <td>:</td>
                <th>{{ $ibu->village ? $ibu->village->name:'' }}</th>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <th>{{ $ibu->alamat }}</th>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <th>{{ $ibu->kode_pos }}</th>
            </tr>
            @else
                Belum ada data ayah yang ditemukan
            @endif
            
        </tbody>
    </table>
</div>