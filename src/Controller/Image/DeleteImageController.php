<?php

namespace App\Controller\Image;

use App\Repository\ImageRepository;
use App\Service\ImageDelete;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteImageController
{
    private $imageRepository;
    private $ImageDelete;

    public function __construct(
        ImageRepository $imageRepository,
        ImageDelete $imageDelete
    )
    {
        $this->imageRepository = $imageRepository;
        $this->ImageDelete = $imageDelete;
    }

    /**
     * @Route("/delete/image/{id_image}", methods="DELETE", name="delete_images")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Request $request): Response
    {
        /* @var \App\Entity\Image $image */
        $image = $this->imageRepository->findOneBy(['id' => $request->attributes->get('id_image')]);

        // Supprime le fichier
        $this->ImageDelete->delete($image);

        // Supprime l'entité
        $this->imageRepository->remove($image);

        return new Response(
            json_encode(
                [
                    'type' => 'success',
                    'message' => 'L\'image a été supprimé'
                ]
            ), Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}