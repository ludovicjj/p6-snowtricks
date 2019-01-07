<?php

namespace App\Controller\User;

use App\DTO\AvatarDTO;
use App\Form\Type\AvatarType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $urlGenerator

    )
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;
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

        return new Response(
            $this->twig->render('layout/form_avatar.html.twig', [
                'form' => $form->createView()
            ])
        );

    }
}