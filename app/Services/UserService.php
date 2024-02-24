<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public function updateUser($userId)
    {
        $user = User::where('id', $userId)->first();
        $user->update([
            'is_aktif' => false,
        ]);
    }
}
