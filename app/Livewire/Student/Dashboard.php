<?php

namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{

    // #[Layout('layouts.student-layout')]
    #[Layout('layouts.app')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.student.dashboard');
    }
}
