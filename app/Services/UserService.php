<?php

namespace App\Services;

use App\Models\User;
use App\DTO\UserDTO;

class UserService
{
    public function getAll()
    {
        return User::where('is_stylist', 0)->get();
    }

    public function create(UserDTO $dto)
    {
        return User::create((array) $dto);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update(User $user, UserDTO $dto)
    {
        $user->update((array) $dto);
        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
