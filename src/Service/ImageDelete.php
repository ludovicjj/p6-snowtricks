<?php

namespace App\Service;

use App\Entity\Image;

class ImageDelete
{
    /**
     * @var string
     */
    private $imageDirectory;

    public function __construct(
        string $imageDirectory
    )
    {
        $this->imageDirectory = $imageDirectory;
    }

    /**
     * @param Image $image
     */
    public function delete(Image $image)
    {
        $oldImage = $this->imageDirectory . '/' . $image->getFilename();

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
    }
}