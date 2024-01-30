<?php

namespace App\Exports;

use App\Models\Scholarship;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BeasiswaExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $beasiswa = Scholarship::with('student')->latest()->limit(500)->get();
        $time_download = date('Y-m-d H:i:s');

        return view('exports.beasiswa-export', compact('beasiswa', 'time_download'));
    }

}
