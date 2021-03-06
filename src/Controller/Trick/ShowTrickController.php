<?php

namespace App\Controller\Trick;

use App\Form\Handler\AddCommentHandler;
use App\Form\Type\CommentType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrickRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ShowTrickController
{
    /**
     * @var TrickRepository
     */
    private $trickRepository;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddCommentHandler
     */
    private $addCommentHandler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(
        TrickRepository $trickRepository,
        Environment $twig,
        FormFactoryInterface $formFactory,
        AddCommentHandler $addCommentHandler,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->trickRepository = $trickRepository;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->addCommentHandler = $addCommentHandler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/figure/{slug}", name="show_trick")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function show(Request $request): Response
    {
        /* @var \App\Entity\Trick $trick */
        $trick = $this->trickRepository->findOneBy(['slug' => $request->attributes->get('slug')]);

        if (!$trick) {
            throw new NotFoundHttpException('Aucune figure ne correspond aux données reçues');
        }

        $form = $this->formFactory->create(CommentType::class)->handleRequest($request);

        if ($this->addCommentHandler->handle($form, $trick)) {

            return new RedirectResponse(
                $this->urlGenerator->generate('show_trick', ['slug' => $trick->getSlug()])
            );
        }

        return new Response(
            $this->twig->render('app/CRUD/show.html.twig', [
                'trick' => $trick,
                'form' => $form->createView()
            ])
        );
    }
}