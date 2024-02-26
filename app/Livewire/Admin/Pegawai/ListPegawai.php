<?php

namespace App\Livewire\Admin\Pegawai;

use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use App\Models\Pegawai;
use App\Models\Pegawaikeluar;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListPegawai extends Component
{
    use LivewireAlert, WithPagination, WithFileUploads;
    public $perPage = 15, $sortColumn = 'nama', $sortDirection = 'asc', $search;
    public $title = 'Daftar Pegawai';
    public $uploadPegawai;

    public $pegawai_id;

    public $tanggal_keluar, $alasan_keluar;

    #[Title('Daftar Pegawai')]

    public function render()
    {

        $pegawais = Pegawai::whereStatus(true)
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage);
        return view('livewire.admin.pegawai.list-pegawai', compact('pegawais'));
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

    public function getUploadPegawaiFileName()
    {
        return $this->uploadPegawai->getClientOriginalName();
    }

    public function unduhTemplate()
    {

        $pathToFile = storage_path('/app/template/format-upload-pegawai.xlsx');
        $filename = 'template_pegawai ' . date('Y_m_d H_i_s') . '.xlsx';
        return response()->download($pathToFile, $filename);

    }

    public function uploadData()
    {
        $this->validate([
            'uploadPegawai' => 'required|file|mimes:xlsx',
        ]);

        $path = $this->uploadPegawai->storeAs('excel_temp', $this->uploadPegawai->getClientOriginalName());

        // Excel::import(new SantriImport, storage_path('app/' . $path));
        $import = new PegawaiImport;
        $import->import($path);

        Storage::delete($path);

        if ($import->failures()) {
            session()->flash('failures', $import->failures());
            return redirect()->route('admin.pegawai.index');
        } else {
            $this->dispatch('close-modal');
            $this->alert('success', 'Data Berhasil di Import');
        }

    }

    public function exportExcel()
    {
        $filename = 'data_pegawai ' . date('Y-m-d H_i_s') . '.xls';
        return Excel::download(new PegawaiExport(true), $filename);
    }

    public function clear()
    {
        $this->pegawai_id = '';
        $this->tanggal_keluar = '';
        $this->alasan_keluar = '';

    }

    public function registrasi($id)
    {
        $this->pegawai_id = $id;
    }

    public function storeRegistration()
    {

        Pegawai::findOrFail($this->pegawai_id)->update([
            'status' => false,
        ]);

        Pegawaikeluar::create([
            'pegawai_id' => $this->pegawai_id,
            'tanggal_keluar' => $this->tanggal_keluar,
            'alasan_keluar' => $this->alasan_keluar,
        ]);

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Data Berhasil diregistrasi');

    }

}
