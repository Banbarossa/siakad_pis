<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActiveStudentImport implements FromQuery, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;
    public function query()
    {
        return Student::query()
            ->where('status_siswa', 'aktif')
            ->leftJoin('provinces', 'students.province_id', '=', 'provinces.id')
            ->leftJoin('regencies', 'students.regency_id', '=', 'regencies.id')
            ->leftJoin('districts', 'students.district_id', '=', 'districts.id')
            ->leftJoin('villages', 'students.village_id', '=', 'villages.id')
            ->select(
                'nama', 'nisn', 'nis_sekolah', 'nis_pesantren', 'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'tahun_masuk',
                'status_sosial', 'status_rumah', 'is_asrama', 'nama_wali', 'nomor_yatim', 'nomor_wali', 'no_kk',
                'hubungan_keluarga', 'anak_ke', 'dari_jumlah_saudara', 'jumlah_saudara_laki_laki', 'jumlah_saudara_perempuan',
                'nomor_registrasi_akte_lahir', 'hobi', 'cita_cita', 'tinggi_badan', 'berat_badan', 'golongan_darah',
                'alamat', 'villages.name', 'districts.name', 'regencies.name', 'provinces.name', 'kode_pos',
                'ayah_nama', 'ayah_nik', 'ayah_tempat_lahir', 'ayah_tanggal_lahir', 'ayah_pendidikan', 'ayah_pekerjaan',
                'ayah_penghasilan', 'ayah_nomor_hp_wa', 'ibu_nama', 'ibu_nik', 'ibu_tempat_lahir', 'ibu_tanggal_lahir',
                'ibu_pendidikan', 'ibu_pekerjaan', 'ibu_penghasilan', 'ibu_nomor_hp_wa'
            );
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NISN',
            'NIS Sekolah',
            'NIS Pesantren',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Tahun Masuk',
            'Status Sosial',
            'Status Rumah',
            'Is Asrama',
            'Nama Wali',
            'Nomor Yatim',
            'Nomor Wali',
            'Nomor KK',
            'Hubungan Keluarga',
            'Anak Ke',
            'Dari Jumlah Saudara',
            'Jumlah Saudara Laki-laki',
            'Jumlah Saudara Perempuan',
            'Nomor Registrasi Akte Lahir',
            'Hobi',
            'Cita-cita',
            'Tinggi Badan',
            'Berat Badan',
            'Golongan Darah',
            'Alamat',
            'Village ID',
            'District ID',
            'Regency ID',
            'Provinsi',
            'Kode Pos',
            'Ayah Nama',
            'Ayah NIK',
            'Ayah Tempat Lahir',
            'Ayah Tanggal Lahir',
            'Ayah Pendidikan',
            'Ayah Pekerjaan',
            'Ayah Penghasilan',
            'Ayah Nomor HP/WA',
            'Ibu Nama',
            'Ibu NIK',
            'Ibu Tempat Lahir',
            'Ibu Tanggal Lahir',
            'Ibu Pendidikan',
            'Ibu Pekerjaan',
            'Ibu Penghasilan',
            'Ibu Nomor HP/WA',
        ];

    }
}
