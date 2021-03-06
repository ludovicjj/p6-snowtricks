<?php

namespace App\Builder\Video;

use App\DTO\VideoDTO;
use App\Entity\Video;
use App\Service\VideoUploader;

class VideoBuilder
{
    /**
     * @var VideoUploader
     */
    private $videoUploader;

    /**
     * VideoBuilder constructor.
     * @param VideoUploader $videoUploader
     */
    public function __construct(VideoUploader $videoUploader)
    {
        $this->videoUploader = $videoUploader;
    }

    /**
     * @param array $videos
     * @return array
     * @throws \Exception
     */
    public function create(array $videos): array
    {
        $collectionVideo = [];

        foreach ($videos as $video) {
            if ($video !== null) {
                $collectionVideo[] = $this->getVideoInfo($video);
            }
        }

        return $collectionVideo;
    }

    /**
     * @param VideoDTO $videoDTO
     * @return Video
     * @throws \Exception
     */
    public function getVideoInfo(VideoDTO $videoDTO)
    {
        $infoVideo = $this->videoUploader->getVideoInfo($videoDTO);

        return new Video(
            $infoVideo['type'],
            $infoVideo['idVideo'],
            $infoVideo['url']
        );
    }
}