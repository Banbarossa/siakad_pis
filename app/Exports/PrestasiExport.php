<?php

namespace App\Exports;

use App\Models\Prestasi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PrestasiExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $prestasis = Prestasi::with('student')->limit(500)->latest()->get();

        $time_download = date('Y-m-d H:i:s');
        return view('exports.prestasi-export', compact('prestasis', 'time_download'));
    }

}
