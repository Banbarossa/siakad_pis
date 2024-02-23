<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class StudentSidebar extends Component
{
    public function render()
    {
        return view('livewire.layouts.student-sidebar');
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();

        Session::regenerate();


        $this->redirect('/',navigate:true);
    }
}
