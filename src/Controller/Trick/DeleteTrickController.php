<?php

namespace App\Controller\Trick;

use App\Builder\Trick\DeleteTrickBuilder;
use App\Repository\TrickRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteTrickController
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TrickRepository
     */
    private $trickRepository;

    /**
     * @var DeleteTrickBuilder
     */
    private $deleteTrickBuilder;

    /**
     * DeleteTrickController constructor.
     * @param UrlGeneratorInterface $urlGenerator
     * @param TrickRepository $trickRepository
     * @param DeleteTrickBuilder $deleteTrickBuilder
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        TrickRepository $trickRepository,
        DeleteTrickBuilder $deleteTrickBuilder
    )
    {
        $this->urlGenerator = $urlGenerator;
        $this->trickRepository = $trickRepository;
        $this->deleteTrickBuilder = $deleteTrickBuilder;
    }

    /**
     * @Route("/figure/supprimer/{slug}", name="delete_trick")
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        /* @var \App\Entity\Trick $trick */
        $trick = $this->trickRepository->findBy(['slug' => $request->attributes->get('slug')]);

        $submittedToken = $request->request->get('token');

        if (!$trick) {
            throw new NotFoundHttpException('Aucune figure ne correspond aux données reçues');
        }

        $this->deleteTrickBuilder->delete($trick, $submittedToken);

        return new RedirectResponse(
            $this->urlGenerator->generate('home')
        );
    }
}