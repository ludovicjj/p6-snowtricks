<?php
/**
 * Created by PhpStorm.
 * User: Ludovic
 * Date: 08/01/2019
 * Time: 07:26
 */

namespace App\Tests\Entity;


use PHPUnit\Framework\TestCase;

class AvatarTest extends TestCase
{
    public function testConstructor()
    {
        $avatar = new Avatar(
            'monimage.jpg',
            '/uploads/images',
            'monimahe.jpg'
        );

    }
}