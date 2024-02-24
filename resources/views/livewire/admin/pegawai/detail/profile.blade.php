<table class="table table-sm">
    <tbody>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <th>{{ $pegawai->nama }}</th>
        </tr>
        <tr>
            <td>NUPL</td>
            <td>:</td>
            <th>{{ $pegawai->nupl }}</th>
        </tr>
        <tr>
            <td>NKK</td>
            <td>:</td>
            <th>{{ $pegawai->no_kk}}</th>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <th>{{ $pegawai->no_nik}}</th>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <th>{{ ucWords($pegawai->jenis_kelamin) }}</th>
        </tr>
        <tr>
            <td>Tempat, Tgl-Lahir</td>
            <td>:</td>
            <th>{{ $pegawai->tempat_lahir }},
                {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}
            </th>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <th>                
                {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->locale('id')->diffForHumans() }}
            </th>
        </tr>
        <tr>
            <td>TMT</td>
            <td>:</td>
            <th>{{ \Carbon\Carbon::parse($pegawai->tmt)->format('d-m-Y') }}
            </th>
        </tr>
        <tr>
            <td>Lama Kerja</td>
            <td>:</td>
            <th>{{ \Carbon\Carbon::parse($pegawai->tmt)->diffForhumans() }}
            </th>
        </tr>
        <tr>
            <td>Status Nikah</td>
            <td>:</td>
            <th>
                @if ($pegawai->status_nikah == 1)
                    Belum Menikah
                @elseif ($pegawai->status_nikah == 2)
                    Menikah
                @elseif ($pegawai->status_nikah == 3)
                    Duda
                @else
                    Janda
                @endif
            </th>
        </tr>
        <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <th>{{ $pegawai->pendidikan_terakhir }}</th>
        </tr>
        <tr>
            <td>Lulusan</td>
            <td>:</td>
            <th>{{ $pegawai->lulusan }}</th>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <th>{{ $pegawai->status ? 'Aktif' :'Tidak Aktif' }}</th>
        </tr>
       
        
       
    </tbody>
</table>