<?php

namespace App\Builder\Trick;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use App\Service\ImageDelete;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class DeleteTrickBuilder
{
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    /**
     * @var ImageDelete
     */
    private $imageDelete;

    private $trickRepository;

    public function __construct(
        CsrfTokenManagerInterface $csrfTokenManager,
        ImageDelete $imageDelete,
        TrickRepository $trickRepository
    )
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->imageDelete = $imageDelete;
        $this->trickRepository = $trickRepository;
    }

    /**
     * @param Trick $trick
     * @param string $submittedToken
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(
        Trick $trick,
        string $submittedToken
    )
    {
        if ($this->csrfTokenManager->isTokenValid(new CsrfToken('delete'.$trick->getId()->toString(), $submittedToken))) {

            foreach ($trick->getImages() as $image) {
                $this->imageDelete->delete($image);
            }

            $this->trickRepository->remove($trick);

            return true;
        } else {
            throw new InvalidCsrfTokenException('Le token est invalide.');
        }
    }
}