<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SantriKeluar implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $students = Student::join('mutasi_keluars', 'students.id', '=', 'mutasi_keluars.student_id')
            ->where('students.status_siswa', 'keluar')
            ->select('students.id', 'students.nama', 'students.nisn', 'students.nis_sekolah', 'students.nis_pesantren', 'mutasi_keluars.tanggal_mutasi', 'mutasi_keluars.sebab_keluar', 'mutasi_keluars.alasan_pindah', 'mutasi_keluars.sekolah_lanjutan', 'mutasi_keluars.npsn')
            ->get();
        $time_download = date('Y-m-d H:i:s');

        return view('exports.santri-keluar-export', compact('students', 'time_download'));
    }
}
