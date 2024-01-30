<?php

namespace App\Exports;

use App\Models\Rombel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AnggotaRombel implements FromView, ShouldAutoSize
{
    /**
     *  @return \Illuminate\Support\Collection
     */

    public $rombel;

    public function __construct(int $id)
    {
        $this->rombel = $id;
    }

    public function view(): View
    {
        $time_download = date('Y-m-d H:i:s');
        $rombel = Rombel::find($this->rombel);

        $anggota_rombel = \App\Models\AnggotaRombel::where('rombel_id', $this->rombel)->with('student', 'rombel')->get();
        return view('exports.anggota-rombel', compact('time_download', 'anggota_rombel', 'rombel'));
    }
}
