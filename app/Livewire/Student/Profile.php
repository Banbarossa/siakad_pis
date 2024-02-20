<?php

namespace App\Livewire\Student;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
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
    #[Layout('layouts.student-layout')]
    public function render()
    {

        return view('livewire.profile-user');
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
