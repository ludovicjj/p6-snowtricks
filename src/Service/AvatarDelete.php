<?php

namespace App\Service;

use App\Entity\Avatar;

class AvatarDelete
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

    public function delete(Avatar $avatar)
    {
        $oldAvatar = $this->imageDirectory . '/' . $avatar->getFilename();

        if (file_exists($oldAvatar)) {
            unlink($oldAvatar);
        }
    }
}