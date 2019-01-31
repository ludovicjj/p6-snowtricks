<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

class CategoryTest extends TestCase
{
    /**
     * @param string $name
     * @throws \Exception
     * @dataProvider providerCategory
     */
    public function testConstructor(string $name)
    {
        $category = new category($name);
        static::assertInstanceOf(Category::class, $category);
        static::assertInstanceOf(UuidInterface::class, $category->getId());
        static::assertEquals($name, $category->getName());
    }

    public function providerCategory()
    {
        yield array('rotations');
        yield array('flips');
        yield array('grabs');
    }
}