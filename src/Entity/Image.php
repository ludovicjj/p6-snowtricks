<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Image
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $alt;

    /**
     * @var Trick
     */
    private $trick;

    /**
     * Image constructor.
     * @param string $filename
     * @param string $path
     * @param string $alt
     * @throws \Exception
     */
    public function __construct(
        string $filename,
        string $path,
        string $alt
    )
    {
        $this->id = Uuid::uuid4();
        $this->filename = $filename;
        $this->path = $path;
        $this->alt = $alt;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function definedTrick(Trick $trick)
    {
        $this->trick = $trick;
    }
}