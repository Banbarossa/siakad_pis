<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mutasi</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Mutasi Keluar</strong></td>
      </tr>
      <tr>
        <td colspan="14">Waktu download : {{$time_download}}</td>
      </tr>
      <tr>
        <td colspan="14">Didownload oleh : ({{Auth::user()->name}})</td>
      </tr>
    </thead>
    <tbody>
      <!-- Guru  -->
      <tr>
      </tr>
      <tr>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NO</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NAMA LENGKAP</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NISN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIS SEKOLAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIS PESANTREN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL MUTASI</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KELUAR KARENA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>ALASAN PINDAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>SEKOLAH LANJUTAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NPSN SEKOLAH LANJUTAN</strong></td>
      </tr>
      <?php $no = 0; ?>
      @foreach($students as $item)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nama }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nisn }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nis_sekolah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nis_pesantren }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal_mutasi }}</td>
        <td style="border: 1px solid #000000;">{{ $item->sebab_keluar }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alasan_pindah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->sekolah_lanjutan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->npsn }}</td>
      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>