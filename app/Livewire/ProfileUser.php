<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

class ProfileUser extends Component
{
    public $name, $email, $password, $password_confirmation;

    public $title = 'Profile Saya';
    #[Title('Profile')]

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;

    }
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
