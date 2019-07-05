<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $names = [
            'rotations',
            'flips',
            'airs',
            'slides',
            'freestyle',
            'grabs'
        ];

        foreach($names as $name)
        {
            $category = new Category($name);

            $manager->persist($category);
            $this->addReference($name, $category);
        }
        $manager->flush();
    }
}