<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Avatar;

class AvatarTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConstructor()
    {
        $avatar = new Avatar(
            'image.jpg',
            '/uploads/images',
            'image.jpg'
        );

        static::assertInstanceOf(Avatar::class, $avatar);
        static::assertEquals('image.jpg', $avatar->getFilename());
        static::assertEquals('/uploads/images', $avatar->getPath());
        static::assertEquals('image.jpg', $avatar->getAlt());
    }
}