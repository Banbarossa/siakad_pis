<div>
    @if ($student->guardian)
    <table>
        <tbody>
            <tr>
                <td class="pr-2">Nama Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_nama}}</td>
            </tr>
            <tr>
                <td class="pr-2">NIK Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_nik}}</td>
            </tr>
            <tr>
                <td class="pr-2">Pendidikan Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_pendidikan}}</td>
            </tr>
            <tr>
                <td class="pr-2">Penghasilan Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_penghasilan}}</td>
            </tr>
            <tr>
                <td class="pr-2">Nomor HP/WA Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_no_hp_wa}}</td>
            </tr>
            <tr>
                <td class="pr-2">Alamat Wali</td>
                <td class="pr-2">:</td>
                <td>{{$student->guardian->wali_alamat}}</td>
            </tr>
            
            
        </tbody>
    </table>
    @else
    😒Tidak Ada Data wali
    @endif
    
</div>