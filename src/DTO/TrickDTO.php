<?php

namespace App\DTO;

use App\Entity\Category;

class TrickDTO
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var Category
     */
    public $category;

    /**
     * @var array
     */
    public $videos;

    /**
     * @var array
     */
    public $images;

    public function __construct(
        string $title = null,
        string $description = null,
        Category $category = null,
        array $videos = null,
        array $images = null
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->videos = $videos;
        $this->images = $images;
    }
}