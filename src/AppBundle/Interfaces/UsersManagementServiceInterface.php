<?php

namespace AppBundle\Interfaces;

use AppBundle\Entity\User;

interface UsersManagementServiceInterface
{
    public function createNewUser(string $email, string $password) : User;

    public function getUserByApiToken(string $token) : User;

    public function createNewApiToken(User $user) : string;
}
