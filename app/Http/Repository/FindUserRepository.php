<?php
namespace App\Http\Repository;

use App\Models\User;

class FindUserRepository
{
    public function userRepository($userId){
        return User::with('balance')->find($userId);
    }
}
