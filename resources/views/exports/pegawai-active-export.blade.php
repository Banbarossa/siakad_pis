<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pegawai</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Pegawai</strong></td>
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
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NUPL</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NO KK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TEMPAT LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENDIDIKAN TERAKHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>LULUSAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TMT</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS NIKAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JENIS KELAMIN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PROVINSI</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KABUPATEN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KECAMATAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>DESA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>ALAMAT</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KODE POS</strong></td>
        
        

      </tr>
      <?php $no = 0; ?>
      @foreach($pegawai as $item)
      <?php $no++; ?>
      <tr>
        <td align="center" style="border: 1px solid #000000;">{{ $no }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nama }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nupl }}</td>
        <td style="border: 1px solid #000000;">{{ $item->no_kk }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nik }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tempat_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->pendidikan_terakhir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->lulusan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->status_rumah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tmt}}</td>
        <td style="border: 1px solid #000000;">{{ $item->status_nikah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jenis_kelamin }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->regency->province->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->regency->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alamat}}</td>
        <td style="border: 1px solid #000000;">{{ $item->kode_pos}}</td>
        

      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>