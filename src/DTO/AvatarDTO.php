<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AvatarDTO
{
    /**
     * @var UploadedFile
     */
    public $avatar;

    /**
     * AvatarDTO constructor.
     * @param UploadedFile|null $avatar
     */
    public function __construct(
        UploadedFile $avatar = null
    )
    {
        $this->avatar = $avatar;
    }
}