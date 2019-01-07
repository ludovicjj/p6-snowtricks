<?php

namespace App\Controller\User;

use App\Entity\User;
use App\DTO\AvatarDTO;
use App\Form\Handler\UpdateAvatarHandler;
use App\Form\Type\AvatarType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class UpdateAvatarUserController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorageInterface;

    /**
     * @var User
     */
    private $user;

    /**
     * @var UpdateAvatarHandler
     */
    private $updateAvatarHandler;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator,
        TokenStorageInterface $tokenStorageInterface,
        UpdateAvatarHandler $updateAvatarHandler

    )
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
        $this->tokenStorageInterface = $tokenStorageInterface;
        $this->updateAvatarHandler = $updateAvatarHandler;
    }

    /**
     * @Route("/compte/avatar", name="update_avatar")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function avatarUpdate(Request $request): Response
    {
        $avatarDTO = new AvatarDTO();

        $form = $this->formFactory->create(AvatarType::class, $avatarDTO, array(
            'action' => $this->urlGenerator->generate($request->get('_route'))
        ))
            ->handleRequest($request)
        ;

        $this->user = $this->tokenStorageInterface->getToken()->getUser();

        if ($this->updateAvatarHandler->handle($form, $this->user)) {
            return new Response('success');
        }

        return new Response(
            $this->twig->render('layout/form_avatar.html.twig', [
                'form' => $form->createView()
            ])
        );

    }
}