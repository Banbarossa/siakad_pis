<?php

namespace App\Livewire\Guest;

use App\Models\Student;
use Livewire\Component;

class PencarianSantri extends Component
{

    public $search;

    public function render()
    {
        $student = [];
        if ($this->search) {
            $student = Student::where('nama', 'like', '%' . $this->search . '%')->paginate(15);

        }

        return view('livewire.guest.pencarian-santri', ['student' => $student])->layout('layouts.guest');

    }
}
