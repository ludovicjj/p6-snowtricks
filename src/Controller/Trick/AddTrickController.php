<?php

namespace App\Controller\Trick;

use App\Form\Type\AddTrickType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AddTrickController
{
    /**
     * @var Environment
     */
    private $twig;

    private $formFactory;


    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory
    )
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route("/figure/ajouter", name="add_trick")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function add(Request $request): Response
    {
        $form = $this->formFactory->create(AddTrickType::class)->handleRequest($request);

        return new Response(
            $this->twig->render('app/CRUD/add.html.twig',[
                'form' => $form->createView()
            ])
        );
    }
}