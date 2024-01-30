<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuruImport implements ToCollection
{

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            if ($key >= 8 && $key <= 30) {
                $user = User::create([
                    'name' => $row[2],
                    'email' => $row[2] . 'gmail.com',
                    'password' => Hash::make('GoAhead'),
                    'level' => 'guru',
                    'is_aktif' => true,
                ]);

                $tanggal_lahir = ($row[6] - 25569) * 86400;
                Guru::create([
                    'user_id' => $user->id,
                    'email' => $row[1] . '@gmaill.com',
                    'nama_lengkap' => strtoupper($row[1]),
                    'gelar' => $row[2],
                    'nip' => $row[3],
                    'jenis_kelamin' => $row[4],
                    'tempat_lahir' => $row[5],
                    'tanggal_lahir' => gmdate('Y-m-d', $tanggal_lahir),
                    'nuptk' => $row[7],
                    'alamat' => $row[8],
                    'password' => $row[3],
                    'avatar' => 'default.png',
                ]);
            }
        }
    }
}
