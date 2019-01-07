<?php

namespace App\Controller\User;

use App\Form\Handler\ResetPasswordHandler;
use App\Form\Type\ResetType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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

    /**
     * @var ResetPasswordHandler
     */
    private $resetPasswordHandler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ResetPasswordUserController constructor.
     * @param UserRepository $userRepository
     * @param FormFactoryInterface $formFactory
     * @param Environment $twig
     * @param ResetPasswordHandler $resetPasswordHandler
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        UserRepository $userRepository,
        FormFactoryInterface $formFactory,
        Environment $twig,
        ResetPasswordHandler $resetPasswordHandler,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->userRepository = $userRepository;
        $this->formFactory = $formFactory;
        $this->twig = $twig;
        $this->resetPasswordHandler = $resetPasswordHandler;
        $this->urlGenerator = $urlGenerator;

    }

    /**
     * @Route("/reinitialiser/{token}", name="security_reset")
     * @param Request $request
     * @return Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function reset(Request $request): Response
    {
        /* @var \App\Entity\User $user */
        $user = $this->userRepository->findOneBy(['token' => $request->attributes->get('token')]);

        if (!$user) {
            throw new NotFoundHttpException('Aucun utilisateur ne correspond a ce token');
        }

        $form = $this->formFactory->create(ResetType::class)->handleRequest($request);

        if ($this->resetPasswordHandler->handle($form, $user)) {
            return new RedirectResponse(
                $this->urlGenerator->generate('security_login')
            );
        }

        return new Response(
            $this->twig->render('app/User/reset.html.twig', [
                'form' => $form->createView()
            ])
        );
    }
}