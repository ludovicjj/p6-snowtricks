<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\Slugger;

class SluggerTest extends TestCase
{
    public function testMakeSlugString()
    {
        $string = 'une phrase avec un caractère avec accent';
        $result = slugger::makeSlug($string);

        /**
         * assertInternalType
         * Test le type scalaire
         * string, entier etc...
         */
        static::assertInternalType('string', $result);
        static::assertEquals('une-phrase-avec-un-caractere-avec-accent', $result);
    }
}