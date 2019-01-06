<?php

namespace App\Controller\Image;

use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteImageController
{
    private $imageRepository;

    public function __construct(
        ImageRepository $imageRepository
    )
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * @Route("/delete/image/{id_image}", methods="DELETE", name="delete_images")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        /* @var \App\Entity\Image $image */
        $image = $this->imageRepository->findOneBy(['id' => $request->attributes->get('id_image')]);
    }
}