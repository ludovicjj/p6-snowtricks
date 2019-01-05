<?php

namespace App\Builder\Image;

use App\DTO\ImageDTO;
use App\Entity\Image;
use App\Service\ImageUploader;

class ImageBuilder
{
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * ImageBuilder constructor.
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        ImageUploader $imageUploader
    )
    {
        $this->imageUploader = $imageUploader;
    }

    /**
     * @param array $images
     * @return array
     * @throws \Exception
     */
    public function create(array $images)
    {
        $imagesCollection = [];

        foreach ($images as $image) {
            if (null !== $image) {
                $imagesCollection[] = $this->createImage($image);
            }
        }

        return $imagesCollection;
    }

    /**
     * @param ImageDTO $imageDTO
     * @return Image
     * @throws \Exception
     */
    public function createImage(ImageDTO $imageDTO): Image
    {
        $info =  $this->imageUploader->getImageInfo($imageDTO->file);

        return new Image(
            $info['filename'],
            $info['path'],
            $info['alt']
        );
    }
}