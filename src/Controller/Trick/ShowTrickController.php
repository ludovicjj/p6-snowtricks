<?php

namespace App\Controller\Trick;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrickRepository;
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

    public function __construct(
        TrickRepository $trickRepository,
        Environment $twig
    )
    {
        $this->trickRepository = $trickRepository;
        $this->twig = $twig;
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

        return new Response(
            $this->twig->render('app/CRUD/show.html.twig', [
                'trick' => $trick
            ])
        );
    }
}