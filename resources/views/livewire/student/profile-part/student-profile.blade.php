<div>
    <table>
        <tbody>
            <tr>
                <td class="pr-2">Nama</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nama}}</td>
            </tr>
            <tr>
                <td class="pr-2">NISN</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nisn}}</td>
            </tr>
            <tr>
                <td class="pr-2">NIS Sekolah</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nis_sekolah}}</td>
            </tr>
            <tr>
                <td class="pr-2">NIS Pesantren</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nis_pesantren}}</td>
            </tr>
            <tr>
                <td class="pr-2">NIK</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nik}}</td>
            </tr>
            <tr>
                <td class="pr-2">Tempat Lahir</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->tempat_lahir}}</td>
            </tr>
            <tr>
                <td class="pr-2">Tanggal Lahir</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->tanggal_lahir}}</td>
            </tr>
            <tr>
                <td class="pr-2">Tahun Masuk</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->tahun_masuk}} <span class="ml-5">sejak :{{\Carbon\Carbon::parse($student->tahun_masuk)->diffForHumans()}}</span></td>
            </tr>
            <tr>
                <td class="pr-2">Status Sosial</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->status_sosial}}</td>
            </tr>
            <tr>
                <td class="pr-2">Status Rumah</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->status_rumah}}</td>
            </tr>
            <tr>
                <td class="pr-2">Asrama</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->is_asrama ? 'Ya' : 'Tidak'}}</td>
            </tr>
           
            <tr>
                <td class="pr-2">Nomor Yatim</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nomor_yatim}}</td>
            </tr>
            
            <tr>
                <td class="pr-2">No KK</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->no_kk}}</td>
            </tr>
            <tr>
                <td class="pr-2">Hubungan Keluarga</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->hubungan_keluarga}}</td>
            </tr>
            <tr>
                <td class="pr-2">Anak Ke</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->anak_ke}} <span class="ml-3">dari : {{$student->dari_jumlah_saudara}}</span></td>
            </tr>
            <tr>
                <td class="pr-2">Nomor Registrasi Akte Lahir</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->nomor_registrasi_akte_lahir}}</td>
            </tr>
            <tr>
                <td class="pr-2">Hobi</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->hobi}}</td>
            </tr>
            <tr>
                <td class="pr-2">Cita-cita</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->cita_cita}}</td>
            </tr>
            <tr>
                <td class="pr-2">Tinggi Badan</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->tinggi_badan}}</td>
            </tr>
            <tr>
                <td class="pr-2">Berat Badan</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->berat_badan}}</td>
            </tr>
            <tr>
                <td class="pr-2">Golongan Darah</td>
                <td class="pr-2">:</td>
                <td class="pr-2">{{$student->golongan_darah}}</td>
            </tr>
            
        </tbody>
    </table>
</div>