<?php

namespace App\Builder\Trick;

use App\Entity\Trick;
use App\DTO\TrickDTO;
use App\Builder\Video\VideoBuilder;

class AddTrickBuilder
{
    /**
     * @var VideoBuilder
     */
    private $videoBuilder;

    public function __construct(
        VideoBuilder $videoBuilder
    )
    {
        $this->videoBuilder = $videoBuilder;
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
            $this->videoBuilder->create($trickDTO->videos)
        );
    }
}