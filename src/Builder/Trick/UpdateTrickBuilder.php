<?php

namespace App\Builder\Trick;

use App\Builder\Image\ImageBuilder;
use App\Builder\Video\UpdateVideoBuilder;
use App\DTO\TrickDTO;
use App\Entity\Trick;

class UpdateTrickBuilder
{
    /**
     * @var Trick
     */
    private $trick;

    /**
     * @var ImageBuilder
     */
    private $imageBuilder;

    /**
     * @var UpdateVideoBuilder
     */
    private $updateVideoBuilder;

    public function __construct(
        ImageBuilder $imageBuilder,
        UpdateVideoBuilder $updateVideoBuilder
    )
    {
        $this->imageBuilder = $imageBuilder;
        $this->updateVideoBuilder = $updateVideoBuilder;
    }

    /**
     * @param TrickDTO $trickDTO
     * @param Trick $trick
     * @return Trick
     * @throws \Exception
     */
    public function update(TrickDTO $trickDTO, Trick $trick)
    {
        $this->trick = $trick;

        $this->trick->update(
            $trickDTO->title,
            $trickDTO->description,
            $trickDTO->title,
            $trickDTO->category,
            $this->updateVideoBuilder->compare($trickDTO->videos, $trick->getVideos()->toArray()),
            $this->imageBuilder->create($trickDTO->images)
        );

        return $this->trick;
    }
}