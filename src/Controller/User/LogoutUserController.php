<?php

namespace App\Controller\User;

use Symfony\Component\Routing\Annotation\Route;

class LogoutUserController
{
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }
}