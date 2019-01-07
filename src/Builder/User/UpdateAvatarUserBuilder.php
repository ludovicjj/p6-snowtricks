<?php

namespace App\Builder\User;

use App\DTO\AvatarDTO;
use App\Entity\Avatar;
use App\Service\ImageUploader;

class UpdateAvatarUserBuilder
{
    /**
     * @var imageUploader
     */
    private $imageUploader;

    /**
     * UpdateAvatarUserBuilder constructor.
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        ImageUploader $imageUploader
    )
    {
        $this->imageUploader = $imageUploader;
    }

    /**
     * @param AvatarDTO $avatarDTO
     * @return Avatar
     * @throws \Exception
     */
    public function updateAvatar(AvatarDTO $avatarDTO)
    {
        return $this->createAvatar($avatarDTO);
    }

    /**
     * @param AvatarDTO $avatarDTO
     * @return Avatar
     * @throws \Exception
     */
    public function createAvatar(AvatarDTO $avatarDTO)
    {
        $info =  $this->imageUploader->getImageInfo($avatarDTO->avatar);

        return new Avatar(
            $info['filename'],
            $info['path'],
            $info['alt']
        );
    }
}