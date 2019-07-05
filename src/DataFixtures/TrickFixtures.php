<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $dataTricks = [
            [
                'title' => 'Free',
                'description' => 'Ceci est la description de la figure Free',
                'slug' => 'Free',
                'category' => 'freestyle',
                'image' => 'image_freestyle'
            ],
            [
                'title' => 'Flip',
                'description' => 'Ceci est la description de la figure Flip',
                'slug' => 'Flip',
                'category' => 'flips',
                'image' => 'image_flip'
            ],
            [
                'title' => 'Rotation',
                'description' => 'Ceci est la description de la figure Rotation',
                'slug' => 'Rotation',
                'category' => 'rotations',
                'image' => 'image_rotation'
            ],
            [
                'title' => 'Jumping',
                'description' => 'Ceci est la description de la figure Jumping',
                'slug' => 'Jumping',
                'category' => 'airs',
                'image' => 'image_air'
            ],
            [
                'title' => 'Nose',
                'description' => 'Ceci est la description de la figure Nose',
                'slug' => 'Nose',
                'category' => 'grabs',
                'image' => 'image_nose_grab'
            ],

        ];

        foreach ($dataTricks as $dataTrick) {
            /** @var \App\Entity\Category $category */
            $category = $this->getReference($dataTrick['category']);
            $image = $this->getReference($dataTrick['image']);

            $trick = new Trick(
                $dataTrick['title'],
                $dataTrick['description'],
                $dataTrick['slug'],
                $category,
                [],
                [$image]
            );

            $manager->persist($trick);
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            ImageFixtures::class
        );
    }
}