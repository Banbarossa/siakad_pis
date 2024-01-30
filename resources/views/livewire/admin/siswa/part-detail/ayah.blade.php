<div class="table-responsive ">
    <table class="table table-sm">
        <tbody>
            @if ($ayah)
            <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{ $ayah->nama }}</th>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <th>{{ $ayah->nik }}</th>
            </tr>
            <tr>
                <td>Tempat, Tgl. Lahir</td>
                <td>:</td>
                <th>{{ $ayah->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($ayah->tanggal_lahir)->format('d-m-Y') }}
                </th>
            </tr>
            <tr>
                <td>Pendidikan Terakhir</td>
                <td>:</td>
                <th>{{ $ayah->pendidikan }}</th>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <th>{{ $ayah->pekerjaan }}</th>
            </tr>
            <tr>
                <td>Penghasilan</td>
                <td>:</td>
                <th>{{ $ayah->penghasilan }}</th>
            </tr>
            <tr>
                <td>No Contact</td>
                <td>:</td>
                <th>{{ $ayah->contact }}</th>
            </tr>
            <tr>
                <td>Province</td>
                <td>:</td>
                <th>{{ $ayah->village ? $ayah->village->district->regency->province->name:'' }}</th>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <th>{{ $ayah->village ? $ayah->village->district->regency->name:'' }}</th>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <th>{{ $ayah->village ? $ayah->village->district->name:'' }}</th>
            </tr>
            <tr>
                <td>Desa/Kelurahan</td>
                <td>:</td>
                <th>{{ $ayah->village ? $ayah->village->name:'' }}</th>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <th>{{ $ayah->alamat }}</th>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <th>{{ $ayah->kode_pos }}</th>
            </tr>
            @else
                Belum ada data ayah yang ditemukan
            @endif
            
        </tbody>
    </table>
</div>