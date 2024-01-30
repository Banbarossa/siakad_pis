<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SantriActiveExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $students = Student::with('village', 'guardians')->where('status_siswa', 'aktif')->orderBy('nama', 'asc')->get();
        $time_download = date('Y-m-d H:i:s');
        return view('exports.santri-active-export', compact('students', 'time_download'));
    }
}
