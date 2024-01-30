<?php

namespace App\Exports;

use App\Models\Pelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PelanggaranExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;
    public function view(): View
    {
        $pelanggarans = Pelanggaran::with('student')->latest()->limit(500)->get();
        $time_download = date('Y_m_d H:i:s');
        return view('exports.pelanggaran-export', compact('pelanggarans', 'time_download'));
    }

}
