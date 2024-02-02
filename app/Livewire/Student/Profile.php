<?php

namespace App\Livewire\Student;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Profile extends Component
{
    public $name, $email, $password, $password_confirmation, $level;

    public $title = 'Profile Saya';

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->level = $user->level;
    }

    #[Title('Profile')]
    public function render()
    {

        return view('livewire.profile-user')->layout('layouts.student-layout');
    }

    public function updateProfile()
    {

        $this->validate([
            'name' => 'required|min:3',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password',
        ]);

        User::find(Auth::user()->id)->update([
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        $this->alert('success', 'Profile User berhasil diupdate');

    }
}
