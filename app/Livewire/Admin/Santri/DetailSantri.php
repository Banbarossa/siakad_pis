<?php

namespace App\Livewire\Admin\Santri;

use App\Models\Student;
use Livewire\Attributes\Title;
use Livewire\Component;

class DetailSantri extends Component
{
    #[Title('Detail Santri')]

    public $title = "Detail Santri";
    public $student;

    public function mount(Student $student)
    {
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.admin.santri.detail-santri');
    }
}
