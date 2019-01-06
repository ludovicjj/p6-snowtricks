<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EnabledUserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(
        UserRepository $userRepository,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/enabled/{token}", name="security_enabled")
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function enabled(Request $request): RedirectResponse
    {
        /* @var \App\Entity\User $user */
        $user = $this->userRepository->findOneBy(['token' => $request->attributes->get('token')]);

        if (!$user) {
            throw new NotFoundHttpException('Aucun utilisateur ne correspond a ce token');
        }

        return new RedirectResponse(
            $this->urlGenerator->generate('home')
        );
    }
}