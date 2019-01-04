<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Video
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $idVideo;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Trick
     */
    private $trick;

    /**
     * Video constructor.
     * @param string $type
     * @param string $idVideo
     * @param string $url
     * @throws \Exception
     */
    public function __construct(
        string $type,
        string $idVideo,
        string $url
    )
    {
        $this->id = Uuid::uuid4();
        $this->type = $type;
        $this->idVideo = $idVideo;
        $this->url = $url;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIdVideo(): string
    {
        return $this->idVideo;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function definedTrick(Trick $trick)
    {
        $this->trick = $trick;
    }
}