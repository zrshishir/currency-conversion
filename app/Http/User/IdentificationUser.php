<?php

namespace App\Http\User;

use App\Http\Repository\FindUserRepository;


class IdentificationUser
{
    private $userRepo;

    public function __construct(){
        $this->userRepo = new FindUserRepository();
    }

    public function checkUser($receiverId) {
        return $this->userRepo->userRepository($receiverId);
    }
}
