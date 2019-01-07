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
     * @var ArrayCollection
     */
    private $comments;

    /**
     * @var int
     */
    private $nbComments;

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
        $this->comments = new ArrayCollection();
        $this->nbComments = 0;

        // Defined trick for each video
        foreach ($videos as $video) {
            $video->definedTrick($this);
        }
        // Defined trick for each image
        foreach ($images as $image) {
            $image->definedTrick($this);
        }
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $slug
     * @param Category $category
     * @param array|null $videos
     * @param array|null $images
     * @throws \Exception
     */
    public function update(
        string $title,
        string $description,
        string $slug,
        Category $category,
        array $videos = null,
        array $images = null
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->slug = Slugger::makeSlug($slug);
        $this->updatedAt = new \DateTime();
        $this->category = $category;
        $this->addVideos($videos);
        $this->addImage($images);
    }

    public function addVideos(array $videos)
    {
        foreach ($videos as $video) {
            $video->definedTrick($this);
            $this->videos[] = $video;
        }
    }

    public function addImage(array $images)
    {
        foreach ($images as $image) {
            $image->definedTrick($this);
            $this->images[] = $image;
        }
    }

    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }

    public function increaseComment(): void
    {
        $this->nbComments++;
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

    public function getComments()
    {
        return $this->comments;
    }

    public function getNbComments(): int
    {
        return $this->nbComments;
    }
}