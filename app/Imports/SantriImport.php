<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SantriImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {

            Student::create([
                'nama' => $row[0],
                'nisn' => $row[1],
                'nis_sekolah' => $row[2],
                'nis_pesantren' => $row[3],
                'nik' => $row[4],
                'ayah_nama' => $row[5],
                'ibu_nama' => $row[6],
                'status_siswa' => $row[7],
            ]);
        }

    }

}
