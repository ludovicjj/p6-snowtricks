<?php

namespace App\Controller\User;


use App\Form\Type\RegistrationType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RegistrationUserController
{
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
     * @Route("/inscription", name="security_registration")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function registration(Request $request)
    {
        $form = $this->formFactory->create(RegistrationType::class)->handleRequest($request);

        return new Response(
            $this->twig->render('app/User/registration.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}