<?php

namespace App\Imports;

use App\Models\Pegawai;
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

class PegawaiImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    // With Validasi Tidak Aktive
    use Importable, SkipsFailures, SkipsErrors;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $item) {
            $user = new User();
            $user->name = $item['nama_lengkap'];
            $user->email = $item['email'];
            $user->password = Hash::make($item['password']);
            $user->level = 'admin';
            $user->is_aktif = 0;
            $user->save();

            $pegawai = new Pegawai();
            $pegawai->user_id = $user->id;
            $pegawai->nupl = $item['nupl'];
            $pegawai->nama = $item['nama_lengkap'];
            $pegawai->no_kk = $item['no_kk'];
            $pegawai->no_nik = $item['nik'];
            $pegawai->tempat_lahir = $item['tempat_lahir'];
            $pegawai->tanggal_lahir = gmdate('Y-m-d', ($item['tanggal_lahir'] - 25569) * 86400);
            $pegawai->pendidikan_terakhir = $item['pendidikan'];
            $pegawai->lulusan = $item['lulusan'];
            $pegawai->tmt = gmdate('Y-m-d', ($item['tmt'] - 25569) * 86400);
            $pegawai->jenis_kelamin = $item['jenis_kelamin'];
            $pegawai->alamat = $item['alamat'];
            $pegawai->kode_pos = $item['kode_pos'];
            $pegawai->save();
        }
    }

    public function headingRow(): int
    {
        return 8;
    }

    public function rules(): array
    {
        return [
            // 'nama_lengkap' => 'required',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:8',
            // 'tempat_lahir' => 'required',

        ];
    }
}
