<?php

namespace App\Imports;

use App\Models\Guardian;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SantriImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $rows)
    {

        // dd($rows);

        foreach ($rows as $row) {

            $user = new User();
            $user->name = $row['nama_lengkap'];
            $user->username = $row['nisn'];
            $user->email = $row['email'];
            $user->password = Hash::make($row['password']);
            $user->level = 'student';
            $user->is_aktif = 1;
            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->nama = $row['nama_lengkap'];
            $student->nisn = $row['nisn'];
            $student->nis_sekolah = $row['nis_sekolah'];
            $student->nis_pesantren = $row['nis_pesantren'];
            $student->nik = $row['nik'];

            if ($row['lp'] == 'L') {
                $jenis_kelamin = 'laki laki';
            } else {
                $jenis_kelamin = 'perempuan';
            }

            $student->jenis_kelamin = $jenis_kelamin;

            $student->tempat_lahir = $row['tempat_lahir'];
            $student->tanggal_lahir = gmdate('Y-m-d', ($row['tanggal_lahir'] - 25569) * 86400);
            $student->tahun_masuk = gmdate('Y-m-d', ($row['tahun_masuk'] - 25569) * 86400);
            $student->status_sosial = strtolower($row['status_sosial']);
            $student->status_rumah = $row['status_rumah'];
            if ($row['tinggal'] == 'Asrama') {
                $asrama = true;
            } else {
                $asrama = false;
            }
            $student->is_asrama = $asrama;
            $student->nama_wali = $row['nama_kafil'];
            $student->nomor_yatim = $row['nomor_kafil'];
            // $student->nomor_wali = $row[''];
            $student->no_kk = $row['no_kk'];
            $student->hubungan_keluarga = $row['hubungan_keluarga'];
            $student->anak_ke = $row['anak_ke'];
            $student->dari_jumlah_saudara = $row['dari_jumlah_saudara'];
            $student->jumlah_saudara_laki_laki = $row['jumlah_saudara_laki_laki'];
            $student->jumlah_saudara_perempuan = $row['jumlah_saudara_perempuan'];
            $student->nomor_registrasi_akte_lahir = $row['no_akte'];
            $student->hobi = $row['hobi'];
            $student->cita_cita = $row['cita_cita'];
            $student->tinggi_badan = $row['tinggi_badan'];
            $student->berat_badan = $row['berat_badan'];
            $student->golongan_darah = $row['golongan_darah'];
            $student->alamat = $row['jalan_alamat'];
            $student->kode_pos = $row['kode_pos'];
            $student->status_siswa = 'aktif';
            $student->is_aktif = true;
            $student->save();

            // ayah

            $ayah = Guardian::firstOrNew([
                'type' => 'ayah',
                'nik' => $row['nik_no_akte_kematian_ayah'],
            ], [
                'nama' => $row['nama_ayah'],
                'student_id' => $student->id,
                'tempat_lahir' => $row['tempat_lahir_ayah'],
                'tanggal_lahir' => gmdate('Y-m-d', ($row['tanggal_lahir_ayah'] - 25569) * 86400),
                'pendidikan' => $row['pendidikan_ayah'],
                'pekerjaan' => $row['pekerjaan_ayah'],
                'penghasilan' => $row['penghasilan_ayah'],
                // 'status' => $row['status_ayah'],
                'contact' => $row['no_hp_ayah'],
                'alamat' => $row['jalan_alamat'],
                'kode_pos' => $row['kode_pos'],
            ]);
            $ayah->save();

            $student->guardians()->attach($ayah->id, ['type' => 'ayah']);

            // ibu

            $ibu = Guardian::firstOrNew([
                'type' => 'ibu',
                'nik' => $row['nikno_akte_kematian_ibu'],
            ], [
                'nama' => $row['nama_ibu'],
                'student_id' => $student->id,
                'tempat_lahir' => $row['tempat_lahir_ibu'],
                'tanggal_lahir' => gmdate('Y-m-d', ($row['tanggal_lahir_ibu'] - 25569) * 86400),
                'pendidikan' => $row['pendidikan_ibu'],
                'pekerjaan' => $row['pendidikan_ibu'],
                'penghasilan' => $row['pekerjaan_ibu'],
                // 'status' => $row['status_ibu'],
                'contact' => $row['no_hp_ibu'],
                'alamat' => $row['jalan_alamat'],
                'kode_pos' => $row['kode_pos'],
            ]);

            $ibu->save();

            $student->guardians()->attach($ibu->id, ['type' => 'ibu']);

            // create User;

            $student->users()->attach($user->id, ['type' => 'student']);

        }

    }

    public function headingRow(): int
    {
        return 8;
    }

    public function rules(): array
    {
        return [
            '*.nama_lengkap' => 'required',
            '*.nisn' => 'nullable|digits:10|unique:students,nisn',
            '*.nik' => 'nullable|digits:16|unique:students,nik',
            '*.nis_pesantren' => 'nullable|digits:6|unique:students,nis_pesantren',
            // '*.email' => 'required|unique:users,email',
            '*.password' => 'required|min:6',
            '*.nik_no_akte_kematian_ayah' => 'required|min:5',
            '*.nama_ayah' => 'required',
            '*.nikno_akte_kematian_ibu' => 'required|min:5',
            '*.nama_ibu' => 'required',

        ];
    }

}
