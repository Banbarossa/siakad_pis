<?php

namespace App\Livewire\Admin\Cetak;

use App\Models\PengajuanSurat;
use App\Traits\JenisSuratTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SuratAktifSiswa extends Component
{
    use JenisSuratTrait;
    use LivewireAlert;
    use WithPagination;

    public $pengajuan;
    public $search, $perPage = 15;
    public $siswa_id;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'created_at', $sortDirection = 'desc';
    public $detailSurat;

    public function render()
    {
        $surat = PengajuanSurat::with('pengajusurat', 'student');

        if ($this->search) {
            $surat = $surat->where(function ($query) {
                $query->whereHas('student', function ($studentQuery) {
                    $studentQuery->where('nama', 'like', '%' . $this->search . '%');
                })
                    ->orWhere('nomor_surat', 'like', '%' . $this->search . '%')
                    ->orWhere('jenis_surat', 'like', '%' . $this->search . '%')
                    ->orWhere('tanggal_pengajuan', 'like', '%' . $this->search . '%');
            });
        }
        $surat = $surat->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.admin.cetak.surat-aktif-siswa', [
            'surat' => $surat,
        ])->layout('layouts.admin-layout');
    }

    public function cetak($id)
    {
        $this->pengajuan = PengajuanSurat::with('student')->where('id', $id)->first();
    }

    public function sortTable($column)
    {
        $this->sortColumn = $column;
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function detail($id)
    {
        $this->detailSurat = PengajuanSurat::with('student', 'pengajusurat', 'penerimasurat')->find($id);

    }

    public function convertToRoman($month)
    {
        $romawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII',
        ];

        return $romawi[$month];
    }

    public function approve($id)
    {
        $lastSurat = PengajuanSurat::whereYear('created_at', now()->year)->latest()->first();

        $nomorUrut = $lastSurat ? intval(explode('/', $lastSurat->nomor_surat)[0]) + 1 : 1;

        $bulanRomawi = $this->convertToRoman(now()->month);

        $nomorSurat = $nomorUrut . '/PIS/' . $bulanRomawi . '/' . now()->year;

        PengajuanSurat::find($id)->update([
            'nomor_surat' => $nomorSurat,
            'tanggal_disetujui' => Carbon::now()->toDateString(),
            'disetujui_oleh' => Auth::user()->id,
        ]);

        $this->alert('success', 'Pengajuan Sudah Berhasil disetujui');
        $this->dispatch('close-modal');
        $this->clear();

    }

    public function clear()
    {
        $this->detailSurat = '';

    }

}
