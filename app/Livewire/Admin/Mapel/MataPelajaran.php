<?php

namespace App\Livewire\Admin\Mapel;

use App\Models\Mapel;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class MataPelajaran extends Component
{
    use LivewireAlert, WithPagination;

    public $is_active = true;

    public $mapel_id;
    public $nama_mapel;
    public $ringkasan_mapel;

    public $sortColumn = 'nama_mapel', $sortDirection = 'asc', $perPage = 15, $search;

    #[Title('Mata Pelajaran')]
    public function render()
    {

        $mapels = Mapel::orderBy($this->sortColumn, $this->sortDirection)
            ->where('is_active', $this->is_active)
            ->when($this->search, function ($query) {
                $query->where('nama_mapel', 'like', '%' . $this->search . '%')
                    ->orWhere('ringkasan_mapel', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.admin.mapel.mata-pelajaran', compact('mapels'));
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
        $validated = $this->validate([
            'nama_mapel' => 'required|unique:mapels,nama_mapel',
            'ringkasan_mapel' => 'required|unique:mapels,nama_mapel|max:50',
        ], [
            'nama_mapel.required' => 'Nama Mata Pelajaran wajib di isi',
            'nama_mapel.unique' => 'Mata Pelajaran ini sudah ada',
            'ringkasan_mapel.required' => 'ringkasan Mata Pelajaran wajib di isi',
            'ringkasan_mapel.unique' => 'Ringkasan Mata Pelajaran ini sudah ada',
        ]);

        Mapel::create($validated);
        $this->clear();
        $this->alert('success', 'Data Mata Pelajaran Berhasil ditambahkan');
        $this->dispatch('close-modal');

    }

    public function clear()
    {
        $this->mapel_id = '';
        $this->nama_mapel = '';
        $this->ringkasan_mapel = '';
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $this->mapel_id = $mapel->id;
        $this->nama_mapel = $mapel->nama_mapel;
        $this->ringkasan_mapel = $mapel->ringkasan_mapel;
    }

    public function update()
    {

        $mapel = Mapel::findOrFail($this->mapel_id);
        $this->validate([
            'nama_mapel' => ['required', Rule::unique(Mapel::class)->ignore($mapel->id)],
            'ringkasan_mapel' => ['required', 'max:50', Rule::unique(Mapel::class)->ignore($mapel->id)],
        ], [
            'nama_mapel.required' => 'Nama Mata Pelajaran wajib di isi',
            'nama_mapel.unique' => 'Mata Pelajaran ini sudah ada',
            'ringkasan_mapel.required' => 'ringkasan Mata Pelajaran wajib di isi',
            'ringkasan_mapel.unique' => 'Ringkasan Mata Pelajaran ini sudah ada',
        ]);

        $mapel->nama_mapel = $this->nama_mapel;
        $mapel->ringkasan_mapel = $this->ringkasan_mapel;
        $mapel->save();

        $this->clear();
        $this->alert('success', 'Data Mata Pelajaran Berhasil diupdate');
        $this->dispatch('close-modal');
    }

    public function changeStatus($id)
    {
        $mapel = Mapel::find($id);
        $mapel->is_active = !$mapel->is_active;
        $mapel->save();
        $this->alert('success', 'Keaktifan Mata Pelajaran Berhasil diperbaharui');
    }

    public function showDataOtherStatus()
    {
        $this->is_active = !$this->is_active;

    }
}
