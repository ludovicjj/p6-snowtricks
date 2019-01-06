<?php

namespace App\Builder\Video;

use App\DTO\VideoDTO;
use App\Entity\Video;
use App\Repository\VideoRepository;

class UpdateVideoBuilder
{
    /**
     * @var array
     */
    private $newUrl = [];

    /**
     * @var array
     */
    private $oldUrl = [];

    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * @var VideoBuilder
     */
    private $videoBuilder;

    public function __construct(
        VideoBuilder $videoBuilder,
        VideoRepository $videoRepository
    )
    {
        $this->videoBuilder = $videoBuilder;
        $this->videoRepository = $videoRepository;
    }

    /**
     * @param array $arrayVideoDTO
     * @param array $arrayVideoEntity
     * @return array
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function compare(array $arrayVideoDTO, array $arrayVideoEntity)
    {
        foreach ($arrayVideoDTO as $key => $videoDTO ) {

            if (array_key_exists($key, $arrayVideoEntity)) {
                $result = $this->compareUrl($arrayVideoEntity[$key], $videoDTO);
                // Modification d'une Url
                if ($result) {
                    $this->oldUrl[] = $arrayVideoEntity[$key];
                    $this->newUrl[] = $videoDTO;
                }
            } else {
                // Ajout d'une Url
                $this->newUrl[] = $videoDTO;
            }
        }
        // Delete
        foreach ($arrayVideoEntity as $key => $video) {
            if (!array_key_exists($key, $arrayVideoDTO)) {
                $this->oldUrl[] = $video;
            }
        }

        foreach ($this->oldUrl as $key => $video) {
            $this->videoRepository->remove($video);
        }

        $newVideoCollection = $this->videoBuilder->create($this->newUrl);

        return $newVideoCollection;
    }

    public function compareUrl(Video $video, VideoDTO $videoDTO): bool
    {
        if ($video->getUrl() == $videoDTO->url) {
            return false;
        } else {
            return true;
        }
    }
}