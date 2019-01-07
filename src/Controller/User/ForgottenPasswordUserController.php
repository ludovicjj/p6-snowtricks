<?php

namespace App\Controller\User;

use App\Form\Type\ForgottenType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ForgottenPasswordUserController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
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
     * @Route("/password", name="security_forgotten")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function forgotten(Request $request): Response
    {
        $form = $this->formFactory->create(ForgottenType::class)->handleRequest($request);

        return new Response(
            $this->twig->render('app/User/forgotten.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}