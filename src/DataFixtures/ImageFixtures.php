<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ImageFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $dataImages = [
            [
                'filename' => 'freestyle.jpg',
                'path' => '/image/image-trick-fixtures/freestyle.jpg',
                'alt' => 'image_freestyle'
            ],
            [
                'filename' => 'flip.jpg',
                'path' => '/image/image-trick-fixtures/flip.jpg',
                'alt' => 'image_flip'
            ],
            [
                'filename' => 'nose_grab.jpg',
                'path' => '/image/image-trick-fixtures/nose_grab.jpg',
                'alt' => 'image_nose_grab'
            ],
            [
                'filename' => 'rotation.jpg',
                'path' => '/image/image-trick-fixtures/rotation.jpg',
                'alt' => 'image_rotation'
            ],
            [
                'filename' => 'air.jpg',
                'path' => '/image/image-trick-fixtures/air.jpg',
                'alt' => 'image_air'
            ],
        ];

        foreach($dataImages as $dataImage)
        {
            $image = new Image(
                $dataImage['filename'],
                $dataImage['path'],
                $dataImage['alt']
            );

            $manager->persist($image);
            $this->addReference($dataImage['alt'], $image);
        }
        $manager->flush();
    }
}