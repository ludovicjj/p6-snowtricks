<?php

namespace App\Controller\User;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class LoginUserController
{
    private $twig;

    public function __construct(
        Environment $twig
    )
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/connexion", name="security_login")
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function login(): Response
    {
        return new Response(
            $this->twig->render('app/User/login.html.twig')
        );
    }
}