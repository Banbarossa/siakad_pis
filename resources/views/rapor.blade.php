<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapor</title>
    @include('rapor-css')
</head>
<body>
    <div class="row">
        <div class="col">
            <table class="table table-noborder">
                <tbody>
                    <tr>
                        <td class="judul-identitas">Nama Siswa</td>
                        <td>:</td>
                        <td>Banbarossa</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">NIS-N</td>
                        <td>:</td>
                        <td>101122002</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">NIS-PIS</td>
                        <td>:</td>
                        <td>21551515</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">NIS-SMP</td>
                        <td>:</td>
                        <td>841645</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col">
            <table class="table table-noborder">
                <tbody>
                    <tr>
                        <td class="judul-identitas">Nama Siswa</td>
                        <td>:</td>
                        <td>SMP Plus Imam syafi'i</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">Kelas</td>
                        <td>:</td>
                        <td>7-2</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">Semester</td>
                        <td>:</td>
                        <td>Ganjil</td>
                    </tr>
                    <tr>
                        <td class="judul-identitas">Tahun Ajaran</td>
                        <td>:</td>
                        <td>2024/2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th colspan="2" rowspan="2">Mata Pelajaran</th>
                <th rowspan="2">KKM</th>
                <th colspan="2">nilai</th>

                <th rowspan="2">Catatan Guru</th>
            </tr>
            <tr>
                <th>Angka</th>
                <th>Huruf</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="fw-bold">Mata Pelajaran Agama Islam</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Bahasa Indo</td>
                <td>الأندونسية</td>
                <td>70</td>
                <td>80</td>
                <td>Delapan Puluh</td>
                <td>Mantap</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Bahasa Indo</td>
                <td>الأندونسية</td>
                <td>70</td>
                <td>80</td>
                <td>Delapan Puluh</td>
                <td>Mantap</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Bahasa Indo</td>
                <td>الأندونسية</td>
                <td>70</td>
                <td>80</td>
                <td>Delapan Puluh</td>
                <td>Mantap</td>
            </tr>
            <tr>
                <td colspan="7" class="fw-bold">Mata Pelajaran Bahasa</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Bahasa Indo</td>
                <td>الأندونسية</td>
                <td>70</td>
                <td>80</td>
                <td>Delapan Puluh</td>
                <td>Mantap</td>
            </tr>
            <tr>
                <td colspan="7" class="fw-bold">Mata Pelajaran Umum</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Bahasa Indo</td>
                <td>الأندونسية</td>
                <td>70</td>
                <td>80</td>
                <td>Delapan Puluh</td>
                <td>Mantap</td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold">Jumlah Nilai</td>
                
                <td>1000</td>
                <td colspan="3" rowspan="2">Peringka Ke :1 dari Jumlah Siswa</td>
                
            </tr>
            <tr>
                <td colspan="4" class="fw-bold">Rata Rata Nilai</td>
                <td>180</td>

            </tr>
        </tbody>
    </table>

    <div class="mt-5">
        <table>
            <thead>
                <tr>
                    <th>Catatan Wali Kelas</th>
                </tr>
            </thead>
            <tbody>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit, similique. Culpa id minima nulla corporis cum itaque suscipit quae repellendus.</td>
            </tbody>
        </table>
    </div>

    <div class="signature mt-5">
        <div class="text-center">
            Orang Tua Wali Siswa
            <br>
            <br>
            <br>
            <br>
            ___________________

        </div>
        <div class="text-center">
            <div>Diberikan Di Sibreh</div>
            <div>Tanggal,10 Februari 2023</div>
            <div>Wali Kelas</div>
            <br>
            <br>
            <br>
            <br>
            <div class="text-deocaration-underline fw-bold">Banbarossa</div>

        </div>
    </div>
    
</body>
</html>