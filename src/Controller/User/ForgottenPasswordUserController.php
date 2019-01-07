<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ForgottenPasswordUserController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        Environment $twig
    )
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/password", name="security_forgotten")
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function forgotten(): Response
    {
        return new Response(
            $this->twig->render('app/User/forgotten.html.twig')
        );
    }
}