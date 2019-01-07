<?php

namespace App\Controller\Trick;

use App\Factory\TrickDTOFactory;
use App\Form\Handler\UpdateTrickHandler;
use App\Form\Type\AddTrickType;
use App\Repository\TrickRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UpdateTrickController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var TrickRepository
     */
    private $trickRepository;

    /**
     * @var TrickDTOFactory
     */
    private $trickDTOFactory;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UpdateTrickHandler
     */
    private $updateTrickHandler;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(
        Environment $twig,
        TrickRepository $trickRepository,
        TrickDTOFactory $trickDTOFactory,
        FormFactoryInterface $formFactory,
        UpdateTrickHandler $updateTrickHandler,
        UrlGeneratorInterface $urlGenerator
    )
    {
        $this->twig = $twig;
        $this->trickRepository = $trickRepository;
        $this->trickDTOFactory = $trickDTOFactory;
        $this->formFactory = $formFactory;
        $this->updateTrickHandler = $updateTrickHandler;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/figure/modifier/{slug}", name="update_trick")
     * @param Request $request
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Exception
     */
    public function update(Request $request): Response
    {
        /* @var \App\Entity\Trick $trick */
        $trick = $this->trickRepository->findOneBy(['slug' => $request->attributes->get('slug')]);

        if (!$trick) {
            throw new NotFoundHttpException('Aucune figure ne correspond aux données reçues');
        }

        $trickDTO = $this->trickDTOFactory->create($trick);

        $form = $this->formFactory->create(AddTrickType::class, $trickDTO)->handleRequest($request);

        if ($this->updateTrickHandler->handle($form, $trick)) {

            return new RedirectResponse(
                $this->urlGenerator->generate('show_trick', ['slug' => $trick->getSlug()])
            );
        }

        return new Response(
            $this->twig->render('app/CRUD/update.html.twig',[
                'form' => $form->createView(),
                'trick' => $trick
            ])
        );
    }
}