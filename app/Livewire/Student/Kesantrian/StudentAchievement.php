<?php

namespace App\Livewire\Student\Kesantrian;

use App\Models\Prestasi;
use App\Models\User;
use App\Traits\SiswaInAccount;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentAchievement extends Component
{

    use SiswaInAccount;
    public $Idstudent;
    public $authId;

    public function mount()
    {
        $auth = Auth::user()->id;
        $this->authId = $auth;
        $siswa = $this->SiswaAktif();
        if ($siswa->count() > 0) {
            $this->Idstudent = $siswa->first()->id;
        }
    }

    public function render()
    {

        $siswa = User::find($this->authId)->students()->get();

        $achievements = Prestasi::where('student_id', $this->Idstudent)->paginate(15);

        return view('livewire.student.kesantrian.student-achievement', [
            'siswa' => $siswa,
            'achievements' => $achievements,
        ])->layout('layouts.student-layout');
    }

    public function changeStudent($idSiswa)
    {

        $this->Idstudent = $idSiswa;

    }
}
