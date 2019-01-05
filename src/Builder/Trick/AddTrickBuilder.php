<?php

namespace App\Builder\Trick;

use App\Entity\Trick;
use App\DTO\TrickDTO;
use App\Builder\Video\VideoBuilder;
use App\Builder\Image\ImageBuilder;

class AddTrickBuilder
{
    /**
     * @var VideoBuilder
     */
    private $videoBuilder;

    /**
     * @var ImageBuilder
     */
    private $imageBuilder;

    public function __construct(
        VideoBuilder $videoBuilder,
        ImageBuilder $imageBuilder
    )
    {
        $this->videoBuilder = $videoBuilder;
        $this->imageBuilder = $imageBuilder;
    }

    /**
     * @param TrickDTO $trickDTO
     * @return Trick
     * @throws \Exception
     */
    public function create(TrickDTO $trickDTO): Trick
    {
        return new trick(
            $trickDTO->title,
            $trickDTO->description,
            $trickDTO->title,
            $trickDTO->category,
            $this->videoBuilder->create($trickDTO->videos),
            $this->imageBuilder->create($trickDTO->images)
        );
    }
}