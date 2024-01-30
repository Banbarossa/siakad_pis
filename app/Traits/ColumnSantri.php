<?php

namespace App\Traits;

trait ColumnSantri
{
    public function primaryProfil()
    {

        return [
            [
                'label' => 'Nama',
                'name' => 'nama',
                'id' => 'nama',
                'type' => 'text',
                'require' => true,
            ],
            [
                'label' => 'Nisn',
                'name' => 'nisn',
                'id' => 'nisn',
                'type' => 'number',
                'require' => true,
            ],
            [
                'label' => 'NIS Sekolah',
                'name' => 'nis_sekolah',
                'id' => 'nis_sekolah',
                'type' => 'number',
                'require' => true,
            ],
            [
                'label' => 'NIS Pesantren',
                'name' => 'nis_pesantren',
                'id' => 'nis_pesantren',
                'type' => 'number',
                'require' => true,
            ],
            [
                'label' => 'Tahun Masuk',
                'name' => 'tahun_masuk',
                'id' => 'tahun_masuk',
                'type' => 'date',
                'require' => true,
            ],
            [
                'label' => 'Nomor Yatim',
                'name' => 'nomor_yatim',
                'id' => 'nomor_yatim',
                'type' => 'text',
                'require' => false,
            ],
            [
                'label' => 'Nomor KK',
                'name' => 'no_kk',
                'id' => 'no_kk',
                'type' => 'text',
                'require' => true,
            ],
            [
                'label' => 'Nomor Registrasi Akte Lahir',
                'name' => 'nomor_registrasi_akte_lahir',
                'id' => 'nomor_registrasi_akte_lahir',
                'type' => 'text',
                'require' => true,
            ],
            [
                'label' => 'Hobi',
                'name' => 'hobi',
                'id' => 'hobi',
                'type' => 'text',
                'require' => false,
            ],
            [
                'label' => 'Cita-cita',
                'name' => 'cita_cita',
                'id' => 'cita_cita',
                'type' => 'text',
                'require' => false,
            ],
            [
                'label' => 'Tinggi Badan',
                'name' => 'tinggi_badan',
                'id' => 'tinggi_badan',
                'type' => 'number',
                'require' => false,
            ],
            [
                'label' => 'Berat Badan',
                'name' => 'berat_badan',
                'id' => 'berat_badan',
                'type' => 'number',
                'require' => false,
            ],
        ];

    }

    public function columnAyah()
    {
        return [
            [
                'label' => 'Nama Ayah',
                'name' => 'ayah_nama',
                'id' => 'ayah_nama',
                'type' => 'text',
            ],
            [
                'label' => 'NIK Ayah',
                'name' => 'ayah_nik',
                'id' => 'ayah_nik',
                'type' => 'text',
            ],
            [
                'label' => 'Nomor HP/WA Ayah',
                'name' => 'ayah_nomor_hp_wa',
                'id' => 'ayah_nomor_hp_wa',
                'type' => 'text',
            ],
            [
                'label' => 'Tempat Lahir Ayah',
                'name' => 'ayah_tempat_lahir',
                'id' => 'ayah_tempat_lahir',
                'type' => 'text',
            ],
            [
                'label' => 'Tanggal Lahir Ayah',
                'name' => 'ayah_tanggal_lahir',
                'id' => 'ayah_tanggal_lahir',
                'type' => 'date',
            ],
            // [
            //     'label' => 'Pendidikan Ayah',
            //     'name' => 'ayah_pendidikan',
            //     'id' => 'ayah_pendidikan',
            //     'type' => 'text',
            // ],
            // [
            //     'label' => 'Pekerjaan Ayah',
            //     'name' => 'ayah_pekerjaan',
            //     'id' => 'ayah_pekerjaan',
            //     'type' => 'text',
            // ],
            // [
            //     'label' => 'Penghasilan Ayah',
            //     'name' => 'ayah_penghasilan',
            //     'id' => 'ayah_penghasilan',
            //     'type' => 'number',
            // ],

        ];

    }
    public function columnIbu()
    {
        return [
            [
                'label' => 'Nama Ibu',
                'name' => 'ibu_nama',
                'id' => 'ibu_nama',
                'type' => 'text',
            ],
            [
                'label' => 'NIK Ibu',
                'name' => 'ibu_nik',
                'id' => 'ibu_nik',
                'type' => 'text',
            ],
            [
                'label' => 'Nomor HP/WA Ibu',
                'name' => 'ibu_nomor_hp_wa',
                'id' => 'ibu_nomor_hp_wa',
                'type' => 'text',
            ],
            [
                'label' => 'Tempat Lahir Ibu',
                'name' => 'ibu_tempat_lahir',
                'id' => 'ibu_tempat_lahir',
                'type' => 'text',
            ],
            [
                'label' => 'Tanggal Lahir Ibu',
                'name' => 'ibu_tanggal_lahir',
                'id' => 'ibu_tanggal_lahir',
                'type' => 'date',
            ],

            // [
            //     'label' => 'Pendidikan Ibu',
            //     'name' => 'ibu_pendidikan',
            //     'id' => 'ibu_pendidikan',
            //     'type' => 'text',
            // ],
            // [
            //     'label' => 'Pekerjaan Ibu',
            //     'name' => 'ibu_pekerjaan',
            //     'id' => 'ibu_pekerjaan',
            //     'type' => 'text',
            // ],
            // [
            //     'label' => 'Penghasilan Ibu',
            //     'name' => 'ibu_penghasilan',
            //     'id' => 'ibu_penghasilan',
            //     'type' => 'number',
            // ],

        ];

    }
}
