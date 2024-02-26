<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PegawaiExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function view(): View
    {
        $pegawai = Pegawai::with('village', )->where('status', $this->status)->orderBy('nama', 'asc')->get();
        $time_download = date('Y-m-d H:i:s');
        return view('exports.pegawai-active-export', compact('pegawai', 'time_download'));
    }
}
