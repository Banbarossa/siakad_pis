<?php

namespace App\Livewire\Admin\Pengaturan;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Console\View\Components\Alert;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class TahunSemester extends Component
{

    public $perPage = 15, $search;
    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortColumn = 'id', $sortDirection = 'desc';

    public $semester_id, $semester, $start_date, $end_date, $tahun_ajaran_id, $status;

    public $tahun, $tahun_start_date, $tahun_end_date;

    public function render()
    {

        $models = Semester::with('tahunAjaran');

        if ($this->search) {
            $models = $models->where(function ($query) {
                $query->where('semester', 'like', "%" . $this->search . "%")
                    ->orWhere('start_date', 'like', "%" . $this->search . "%")
                    ->orWhere('end_date', 'like', "%" . $this->search . "%")
                    ->orWhereHas('tahunAjaran', function ($query) {
                        $query->where('tahun', 'like', "%" . $this->search . "%");
                    });
            });
        }

        $models = $models->orderBy($this->sortColumn, $this->sortDirection)->limit(500)->paginate($this->perPage);

        $tahun = TahunAjaran::orderBy('tahun', 'asc')->get();
        return view('livewire.admin.pengaturan.tahun-semester', [
            'models' => $models,
            'model_tahun' => $tahun,
        ])
            ->layout('layouts.admin-layout');
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

    public function store()
    {
        $model = new Semester();
        $model->semester = $this->semester;
        $model->start_date = $this->start_date;
        $model->end_date = $this->end_date;
        $model->tahun_ajaran_id = $this->tahun_ajaran_id;
        $model->status = false;

        $model->save();
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Status berhasil diupdate');

    }

    public function clear()
    {
        $this->semester_id = '';
        $this->semester = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->tahun_ajaran_id = '';
        $this->status = '';

    }

    public function edit($id)
    {
        $semester = Semester::find($id);
        $this->semester_id = $semester->id;
        $this->semester = $semester->semester;
        $this->start_date = $semester->start_date;
        $this->end_date = $semester->end_date;
        $this->tahun_ajaran_id = $semester->tahun_ajaran_id;
        $this->status = $semester->status;

    }

    public function update()
    {
        Semester::find($this->semester_id)->update([
            'semester' => $this->semester,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Status berhasil diupdate');
    }

    public function updateStatus($id)
    {
        $semester = Semester::all();
        foreach ($semester as $item) {
            $item->update(['status' => false]);
        }

        $update = Semester::find($id);
        $update->update(['status' => true]);

        // Update Tahun
        $tahun = TahunAjaran::all();
        foreach ($tahun as $item) {
            $item->update(['status' => false]);
        }
        TahunAjaran::find($update->tahun_ajaran_id)->update(['status' => true]);
        $this->clear();
        $this->alert('success', 'Status berhasil diubah');

    }

    public function tambahTahun()
    {

        $this->validate([
            'tahun' => 'required|min:9|max:9|unique:tahun_ajarans,tahun',
            'tahun_start_date' => 'required|date',
            'tahun_end_date' => 'required|date',
        ]);

        $tahun = new TahunAjaran();
        $tahun->tahun = $this->tahun;
        $tahun->last_year = substr($this->tahun, 5, 4);
        $tahun->start_date = $this->tahun_start_date;
        $tahun->end_date = $this->tahun_end_date;
        $tahun->status = false;
        $tahun->save();

        $this->clear();
        $this->dispatch('close-modal');
        $this->alert('success', 'Status berhasil diubah');

    }
}
