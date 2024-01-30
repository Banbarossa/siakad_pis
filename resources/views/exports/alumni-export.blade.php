<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Alumni</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Alumni</strong></td>
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
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JENIS KELAMIN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TEMPAT LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TAHUN MASUK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS SOSIAL</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TAHUN LULUS</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENDIDIKAN LANJUTAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>CONTACT</strong></td>
      </tr>
      <?php $no = 0; ?>
      @foreach($alumni as $item)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nama }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nisn }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nis_sekolah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nis_pesantren }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nik }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jenis_kelamin }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tempat_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tahun_masuk }}</td>
        <td style="border: 1px solid #000000;">{{ $item->status_sosial }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alumni ? $item->alumni->tanggal_lulus :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alumni ? $item->alumni->lanjutan_pendidikan :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alumni ? $item->alumni->contact :'' }}</td>
      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>