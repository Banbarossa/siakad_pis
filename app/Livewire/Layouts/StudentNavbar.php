<?php

namespace App\Livewire\Layouts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class StudentNavbar extends Component
{
    public function render()
    {
        return view('livewire.layouts.student-navbar');
    }

    public function logout()
    {

        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
