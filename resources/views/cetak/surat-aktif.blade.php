<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Aktif</title>
    <style>
    .pr-3{
      padding-right: 0.7rem
    }
    </style>
</head>

<body>

    <div class="px-5 pt-2">
        <div class="mb-3 text-center form-group" style="padding: 0px 6px;">
            <img src="{{ asset('images/kop.jpg') }}" alt="kop" style="width: 100%">
        </div>
        <main style="margin: 0px 2.3rem">
            <div style="margin: 2rem 0px">
                <h3 style="text-decoration:underline; text-align:center;margin:0px 0px">SURAT AKTIF BELAJAR</h3>
                <H3 style="text-align: center; margin: 0px 0px;">{{ $pengajuan->nomor_surat }}</H3>
            </div>
            <div class="form-group">
                <p style="text-align: justify">
                    Pimpinan {{ ucWords($lembaga->nama_lembaga) }} Kecamatan {{ ucWords(strtolower($lembaga->village->district->name)) }} Kabupaten {{ ucWords(strtolower($lembaga->village->district->regency->name)) }} dengan ini menerangkan bahwa:
                </p>
            </div>
            <div class="mt-3 form-group">
                <table>
                    <tbody>
                        <tr>
                            <td class="pr-3">Nama</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ UcFirst($pengajuan->nama) }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Tempat, Tgl Lahir</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ ucWords($pengajuan->ttl) }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">NISP/NISN</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ $pengajuan->nisp_nisn }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Jenis Kelamin</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ $pengajuan->student->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Kelas</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3"></td>
                        </tr>
                        <tr>
                            <td class="pr-3">Alamat</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3" style="word-wrap: break-word">{{ $pengajuan->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3" colspan="3"><br></td>
                        </tr>
                        <tr>
                            <td class="pr-3" colspan="3"><br></td>
                        </tr>
                        <tr>
                            <td class="pr-3" colspan="3">Anak dari:</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Nama</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ $pengajuan->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td class="pr-3">Pekerjaan</td>
                            <td class="pr-3">:</td>
                            <td class="pr-3">{{ $pengajuan->pekerjaan_ayah }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="mt-3 form-group">
                <p style="text-align: justify">
                    Dengan ini menyatakan bahwan nama yang tersebut diatas benar masih aktif sebagai
                    santri di {{ ucWords($lembaga->nama_lembaga) }} {{ ucWords(strtolower($lembaga->village->district->name)) }} - {{ ucWords(strtolower($lembaga->village->district->regency->name)) }} Tahun Pelajaran {{ $pengajuan->tahun_pelajaran }}.
                </p>
                <p style="text-align: justify">
                    Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
                    <span style="font-style: italic">Jazaakumullahukhairan</span>
                </p>
            </div>
            <div class="mt-5 d-flex justify-content-between">
                {{-- <div class="text-center visible-print">
                    <div>
                        {{ Request::routeIs('cek.surat'),'dhakhdka' }}
                    </div>
                </div> --}}
                <div style="float: right; display: inline; margin-top: 3rem">
                    <div style="margin-bottom: 10px">
                        Sibreh,
                        {{ \Carbon\Carbon::parse($pengajuan->created_at)->locale('id')->format('d F Y') }}
                    </div>
                    <div style="margin-bottom: 10px">Pimpinan Pesantren</div>
                    <img src="data:image/png;base64, {!! $qrcode !!}" style="height: 3.5rem;">
                    <div style="font-weight: 700; margin-top:10px">{{ $pengajuan->nama_tt }}</div>
                    <div style="font-weight: 400">{{ $pengajuan->nupl_tt }}</div>

                </div>


            </div>
        </main>

    </div>

</body>

</html>
