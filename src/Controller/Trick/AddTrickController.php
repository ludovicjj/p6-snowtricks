<?php

namespace App\Controller\Trick;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AddTrickController
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
     * @Route("/figure/ajouter", name="add_trick")
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add(): Response
    {
        return new Response(
            $this->twig->render('app/CRUD/add.html.twig',[

            ])
        );
    }
}