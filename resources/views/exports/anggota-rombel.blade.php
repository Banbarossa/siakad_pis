<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Rombel</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td colspan="4"><strong>Anggota Rombel {{ $rombel->nama_rombel }}</strong></td>
            </tr>
            <tr>
                <td colspan="4">Waktu download : {{ $time_download }}</td>
            </tr>
            <tr>
                <td colspan="4">Didownload oleh : ({{ Auth::user()->name }})</td>
            </tr>
        </thead>
        <tbody>
            <!-- Guru  -->
            <tr>
            </tr>
            <tr>
                <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NO</strong>
                </td>
                <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NAMA
                        SISWA</strong></td>
                <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NISN</strong>
                </td>
                <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;">
                    <strong>JENIS_PENDAFTARAN</strong></td>

            </tr>
            <?php $no = 0; ?>
            @foreach($anggota_rombel as $anggota)
                <?php $no++; ?>
                <tr>
                    <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
                    <td style="border: 1px solid #000000;">
                        {{ $anggota->student ? $anggota->student->nama :'' }}</td>
                    <td style="border: 1px solid #000000;">
                        {{ $anggota->student ? $anggota->student->nisn:'' }}</td>

                    <td style="border: 1px solid #000000;">
                        @if($anggota->pendaftaran == 1)
                            Siswa Baru
                            @elseIf($anggota->pendaftaran == 2)
                                Pindahan
							@elseIf($anggota->pendaftaran == 3)
								Naik Kelas
							@elseif($anggota->pendaftaran == 4)
								Lanjutan Semester
							@else
								Mengulang
						@endif
                    </td>
                </tr>
            @endforeach
            <!-- End Guru  -->
        </tbody>
    </table>
</body>

</html>
