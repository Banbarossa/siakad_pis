<table class="table table-sm">
    <tbody>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <th>{{ $student->nama }}</th>
        </tr>
        <tr>
            <td>NISN</td>
            <td>:</td>
            <th>{{ $student->nisn }}</th>
        </tr>
        <tr>
            <td>NIS Sekolah</td>
            <td>:</td>
            <th>{{ $student->nis_sekolah }}</th>
        </tr>
        <tr>
            <td>NIS Pesantren</td>
            <td>:</td>
            <th>{{ $student->nis_pesantren }}</th>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <th>{{ ucFirst($student->jenis_kelamin) }}</th>
        </tr>
        <tr>
            <td>Tempat, Tg-Lahir</td>
            <td>:</td>
            <th>{{ $student->tempat_lahir }},
                {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d-m-Y') }}
            </th>
        </tr>
        <tr>
            <td>Usia</td>
            <td>:</td>
            <th>
                {{ ucFirst(\Carbon\Carbon::parse($student->tanggal_lahir)->locale('id')->diffForHumans(null, true, false, 2)) }}
            </th>
        </tr>
        <tr>
            <td>Tahun Masuk</td>
            <td>:</td>
            <th>{{ \Carbon\Carbon::parse($student->tahun_masuk)->format('d-m-Y') }}</th>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <th>{{ ucFirst($student->status_sosial) }}</th>
        </tr>
        <tr>
            <td>Status Rumah</td>
            <td>:</td>
            <th>{{ $student->status_rumah }}</th>
        </tr>
        <tr>
            <td>Tinggal</td>
            <td>:</td>
            <th>{{ $student->is_asrama ? 'Asrama' :'Non Asrama'}}</th>
        </tr>
       
            <td>Nomor Kartu Keluarga</td>
            <td>:</td>
            <th>{{ $student->no_kk }}</th>
        </tr>
        <tr>
            <td>Hubungan Keluarga</td>
            <td>:</td>
            <th>{{ ucFirst($student->hubungan_keluarga) }}</th>
        </tr>
        <tr>
            <td>Anak Ke</td>
            <td>:</td>
            <th> <span class="px-2 mr-3 badge bg-primary">{{ $student->anak_ke }}</span> dari :
               <span class="px-2 mx-3 badge bg-primary">{{ $student->dari_jumlah_saudara }}</span>  Bersaudara</th>
        </tr>
        <tr>
            <td>Jumlah saudara</td>
            <td>:</td>
            <th>Laki Laki : <span class="px-2 mx-3 badge bg-primary">{{ $student->jumlah_saudara_laki_laki }}</span>  Perempuan
                : <span class="px-2 mx-3 badge bg-primary">{{ $student->jumlah_saudara_perempuan }}</span></th>
        </tr>
        <tr>
            <td>No Akte Lahir</td>
            <td>:</td>
            <th>{{ $student->nomor_registrasi_akte_lahir }}</th>
        </tr>
        
       
    </tbody>
</table>