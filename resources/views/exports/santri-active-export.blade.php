<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Santri Aktif</title>
</head>

<body>
  <table>
    <thead>
      <tr>
        <td colspan="14"><strong>Data Santri Aktif</strong></td>
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
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TEMPAT LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TAHUN MASUK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS SOSIAL</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS RUMAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>ASRAMA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NAMA DONATUR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NOMOR YATIM</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NOMOR WALI</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NOMOR KK</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>HUBUNGAN KELUARGA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>ANAK KE</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JUMLAH SAUDARA LAKI-LAKI</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>JUMLAH SAUDARA PEREMPUAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NOMOR AKTE LAHIR</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>HOBI</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>CITA CITA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TINGGI BADAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>BERAT BADAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>GOLONGAN DARAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PROVINCE</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KABUPATEN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KECAMATAN</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>DESA</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>ALAMAT</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>KODE POS</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NAMA AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIK AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TEMPAT LAHIR AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL LAHIR AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENDIDIKAN AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PEKERJAAN AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENGHASILAN AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>CONTACT AYAH</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NAMA IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>NIK IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TEMPAT LAHIR IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>TANGGAL LAHIR IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENDIDIKAN IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PEKERJAAN IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>PENGHASILAN IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>STATUS IBU</strong></td>
        <td align="center" style="border: 1px solid #000000; background-color: #d9ecd0;"><strong>CONTACT IBU</strong></td>

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
        <td style="border: 1px solid #000000;">{{ $item->nik }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jenis_kelamin }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tempat_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tanggal_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tahun_masuk }}</td>
        <td style="border: 1px solid #000000;">{{ $item->status_sosial }}</td>
        <td style="border: 1px solid #000000;">{{ $item->status_rumah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->is_asrama ? 'Asrama':'Tidak Asrama' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nama_wali }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nomor_yatim }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nomor_wali }}</td>
        <td style="border: 1px solid #000000;">{{ $item->no_kk }}</td>
        <td style="border: 1px solid #000000;">{{ $item->hubungan_keluarga }}</td>
        <td style="border: 1px solid #000000;">{{ $item->anak_ke }} dari {{ $item->dari_jumlah_saudara }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jumlah_saudara_laki_laki }}</td>
        <td style="border: 1px solid #000000;">{{ $item->jumlah_saudara_perempuan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->nomor_registrasi_akte_lahir }}</td>
        <td style="border: 1px solid #000000;">{{ $item->hobi }}</td>
        <td style="border: 1px solid #000000;">{{ $item->cita_cita }}</td>
        <td style="border: 1px solid #000000;">{{ $item->tinggi_badan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->berat_badan }}</td>
        <td style="border: 1px solid #000000;">{{ $item->golongan_darah }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->regency->province->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->regency->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->district->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->village ? $item->village->name :'' }}</td>
        <td style="border: 1px solid #000000;">{{ $item->alamat}}</td>
        <td style="border: 1px solid #000000;">{{ $item->kode_pos}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->nama}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->nik}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->tempat_lahir}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->tanggal_lahir}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->pendidikan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->pekerjaan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->penghasilan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->status}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ayah')->first())->contact}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->nama}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->nik}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->tempat_lahir}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->tanggal_lahir}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->pendidikan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->pekerjaan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->penghasilan}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->status}}</td>
        <td style="border: 1px solid #000000;">{{ optional($item->guardians->where('pivot.type','ibu')->first())->contact}}</td>

      </tr>
      @endforeach
      <!-- End Guru  -->
    </tbody>
  </table>
</body>

</html>