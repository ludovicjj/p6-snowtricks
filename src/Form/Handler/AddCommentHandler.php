<?php

namespace App\Form\Handler;

use App\Builder\Comment\CommentBuilder;
use App\Entity\Trick;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\TrickRepository;

class AddCommentHandler
{
    /**
     * @var CommentBuilder
     */
    private $commentBuilder;

    /**
     * @var TrickRepository
     */
    private $trickRepository;

    /**
     * @var SessionInterface
     */
    private $sessionInterface;

    /**
     * AddCommentHandler constructor.
     * @param CommentBuilder $commentBuilder
     * @param TrickRepository $trickRepository
     * @param SessionInterface $sessionInterface
     */
    public function __construct(
        CommentBuilder $commentBuilder,
        TrickRepository $trickRepository,
        SessionInterface $sessionInterface
    )
    {
        $this->commentBuilder = $commentBuilder;
        $this->trickRepository = $trickRepository;
        $this->sessionInterface = $sessionInterface;
    }

    /**
     * @param FormInterface $form
     * @param Trick $trick
     * @return bool
     * @throws \Exception
     */
    public function handle(FormInterface $form, Trick $trick): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $comment = $this->commentBuilder->createComment($form->getData(), $trick);

            $trick->addComment($comment);
            $trick->increaseComment();

            // Message Flash
            $this->sessionInterface->getFlashBag()->add('comment-success', 'Votre commentaire a été rajouté avec succès');

            $this->trickRepository->save();

            return true;
        }

        return false;
    }
}