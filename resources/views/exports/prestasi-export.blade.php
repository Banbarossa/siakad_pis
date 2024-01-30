<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Prestasi Siswa</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Prestasi Siswa</strong></td>
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
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TINGKAT</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PERINGKAT</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>DESKRIPSI</strong></td>
      </tr>
      <?php $no = 0; ?>
      @foreach($prestasis as $item)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
        <td style="border: 1px solid #000000;">{{ $item->student->nama }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tingkat }}</td>
        <td style="border: 1px solid #000000;">{{ $item->peringkat }}</td>
        <td style="border: 1px solid #000000;">{{ $item->deskripsi}}</td>
      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>