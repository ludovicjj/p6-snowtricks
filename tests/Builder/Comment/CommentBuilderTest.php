<?php

namespace App\Tests\Builder\Comment;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentBuilderTest extends TestCase
{
    /**
     * @param User $user
     * @param Trick $trick
     * @throws \Exception
     * @dataProvider providerComment
     */
    public function testCreateComment(User $user, Trick $trick)
    {
        $comment = new Comment(
            'commentaire',
            $trick,
            $user
        );

        static::assertInstanceOf(Comment::class, $comment);
    }

    /**
     * @throws \Exception
     */
    public function providerComment()
    {
        $user = new User();
        $trick = new Trick(
            'article1',
            'description',
            'article1',
            new Category('test')
        );

        yield array($user, $trick);
    }


}