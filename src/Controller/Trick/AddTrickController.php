<?php

namespace App\Controller\Trick;


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
     */
    public function add()
    {

    }
}