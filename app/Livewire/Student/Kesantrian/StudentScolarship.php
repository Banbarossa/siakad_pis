<?php

namespace App\Livewire\Student\Kesantrian;

use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StudentScolarship extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $student_ids = [];
    public $authId;
    public $search;

    public function mount()
    {
        $auth = Auth::user()->id;
        $this->authId = $auth;
        $siswa = User::find($auth)->students()->get();

        $this->student_ids = [];

        foreach ($siswa as $student) {
            $this->student_ids[] = $student->id;
        }
    }

    public function render()
    {

        $beasiswa = Scholarship::whereIn('student_id', $this->student_ids)
            ->with('student')
            ->latest();

        if ($this->search) {
            $beasiswa = $beasiswa->where(function ($query) {
                $query->whereHas('student', function ($studentQuery) {
                    $studentQuery->where('nama', 'like', '%' . $this->search . '%');
                })
                    ->orWhere('tahun', 'like', '%' . $this->search . '%')
                    ->orWhere('sumber', 'like', '%' . $this->search . '%')
                    ->orWhere('jumlah', 'like', '%' . $this->search . '%');
            });
        }
        $beasiswa = $beasiswa->paginate(15);

        return view('livewire.student.kesantrian.student-scolarship', [
            'beasiswa' => $beasiswa,
        ])->layout('layouts.student-layout');
    }
}
