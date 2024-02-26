<?php

namespace App\Livewire\Admin\Pegawai;

use App\Exports\PegawaiExport;
use App\Models\Pegawai;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiNonAktif extends Component
{

    use LivewireAlert, WithPagination;
    public $perPage = 15, $sortColumn = 'nama', $sortDirection = 'asc', $search;
    public $title = 'Daftar Pegawai';
    public $uploadPegawai;

    public $pegawai_id;

    public $tanggal_keluar, $alasan_keluar;

    #[Title('Daftar Pegawai')]
    public function render()
    {
        $pegawais = Pegawai::whereStatus(false)
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.pegawai.pegawai-non-aktif', compact('pegawais'));
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

    public function exportExcel()
    {
        $filename = 'data_pegawai ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new PegawaiExport(false), $filename);
    }

}
