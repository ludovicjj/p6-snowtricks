<?php

namespace App\Controller\User;

use App\Builder\User\EnabledUserBuilder;
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

    /**
     * @var EnabledUserBuilder
     */
    private $enabledUserBuilder;

    /**
     * EnabledUserController constructor.
     * @param UserRepository $userRepository
     * @param UrlGeneratorInterface $urlGenerator
     * @param EnabledUserBuilder $enabledUserBuilder
     */
    public function __construct(
        UserRepository $userRepository,
        UrlGeneratorInterface $urlGenerator,
        EnabledUserBuilder $enabledUserBuilder
    )
    {
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;
        $this->enabledUserBuilder = $enabledUserBuilder;
    }

    /**
     * @Route("/enabled/{token}", name="security_enabled")
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function enabled(Request $request): RedirectResponse
    {
        /* @var \App\Entity\User $user */
        $user = $this->userRepository->findOneBy(['token' => $request->attributes->get('token')]);

        if (!$user) {
            throw new NotFoundHttpException('Aucun utilisateur ne correspond a ce token');
        }

        $this->enabledUserBuilder->enabled($user);

        return new RedirectResponse(
            $this->urlGenerator->generate('home')
        );
    }
}