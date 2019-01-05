<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageDTO
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function __construct(
        UploadedFile $file = null
    )
    {
        $this->file = $file;
    }
}