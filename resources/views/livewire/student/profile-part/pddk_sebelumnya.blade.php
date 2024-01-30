<div>
    @if ($pendidikansebelumnya)
    <table>
        <tbody>
            <tr>
                <td class="pr-2">Nama Sekolah</td>
                <td class="pr-2">:</td>
                <td>{{$pendidikansebelumnya->nama_sekolah}}</td>
            </tr>
            <tr>
                <td class="pr-2">Jenjang</td>
                <td class="pr-2">:</td>
                <td>{{$pendidikansebelumnya->jenjang}}</td>
            </tr>
            <tr>
                <td class="pr-2">NPSN</td>
                <td class="pr-2">:</td>
                <td>{{$pendidikansebelumnya->npsn}}</td>
            </tr>
            <tr>
                <td class="pr-2">Alamat</td>
                <td class="pr-2">:</td>
                <td>{{$pendidikansebelumnya->alamat}}</td>
            </tr>
            
        </tbody>
    </table>
    @else
    😒Tidak Ada Data Pendidikan Sebelumnya
    @endif
    
</div>