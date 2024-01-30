<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LulusanExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $time_download = date('Y-m-d H:i:s');
        $alumni = Student::with('alumni')->where('status_siswa', 'lulus')->orderBy('nama')->get();
        return view('exports.alumni-export', compact('alumni', 'time_download'));
    }
}
