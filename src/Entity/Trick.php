<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Service\Slugger;
use Doctrine\Common\Collections\ArrayCollection;

class Trick
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var ArrayCollection
     */
    private $videos;

    /**
     * @var ArrayCollection
     */
    private $images;

    /**
     * Trick constructor.
     * @param string $title
     * @param string $description
     * @param string $slug
     * @param Category $category
     * @param array $videos
     * @param array $images
     * @throws \Exception
     */
    public function __construct(
        string $title,
        string $description,
        string $slug,
        Category $category,
        array $videos = [],
        array $images = []
    )
    {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->description = $description;
        $this->slug = Slugger::makeSlug($slug);
        $this->createdAt = new \DateTime();
        $this->category = $category;
        $this->videos = new ArrayCollection($videos);
        $this->images = new ArrayCollection($images);

        // Defined trick for each video
        foreach ($videos as $video) {
            $video->definedTrick($this);
        }
        // Defined trick for each image
        foreach ($images as $image) {
            $image->definedTrick($this);
        }
    }

    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getVideos()
    {
        return $this->videos;
    }

    public function getImages()
    {
        return $this->images;
    }
}