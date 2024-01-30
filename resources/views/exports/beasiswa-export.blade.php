<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Besaiswa</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Besaiswa</strong></td>
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
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TAHUN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>BULAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL TERIMA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>SUMBER</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JUMLAH</strong></td>
      </tr>
      <?php $no = 0; ?>
      @foreach($beasiswa as $item)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
        <td style="border: 1px solid #000000;">{{ $item->student->nama }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tahun }}</td>
        <td style="border: 1px solid #000000;">{{ $item->bulan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal_terima }}</td>
        <td style="border: 1px solid #000000;">{{ $item->sumber }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jumlah }}</td>
      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>