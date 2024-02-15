<?php

namespace App\Livewire\Guest;

use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PencarianSantri extends Component
{

    public $search;

    #[Layout('layouts.login-layout')]
    public function render()
    {
        $student = [];
        if ($this->search) {
            $student = Student::where('nama', 'like', '%' . $this->search . '%')->paginate(15);

        }

        return view('livewire.guest.pencarian-santri', ['student' => $student]);

    }
}
