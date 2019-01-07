<?php

namespace App\Controller\User;

use App\Form\Type\ResetType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class ResetPasswordUserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        UserRepository $userRepository,
        FormFactoryInterface $formFactory,
        Environment $twig
    )
    {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
    }

    /**
     * @Route("/reinitialiser/{token}", name="security_reset")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function reset(Request $request): Response
    {
        $user = $this->userRepository->findOneBy(['token' => $request->attributes->get('token')]);

        if (!$user) {
            throw new NotFoundHttpException('Aucun utilisateur ne correspond a ce token');
        }

        $form = $this->formFactory->create(ResetType::class)->handleRequest($request);

        return new Response(
            $this->twig->render('app/User/reset.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}