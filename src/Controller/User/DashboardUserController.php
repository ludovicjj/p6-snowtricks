<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DashboardUserController
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
     * @Route("/compte", name="dashboard_home")
     *
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function dashboard(): Response
    {
        return new Response(
            $this->twig->render('app/User/dashboard.html.twig')
        );
    }
}