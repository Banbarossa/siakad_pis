<?php

namespace App\Livewire\Student;

use Livewire\Component;

class KalenderAkademik extends Component
{
    public function render()
    {
        return view('livewire.student.kalender-akademik')->layout('layouts.student-layout');
    }
}
