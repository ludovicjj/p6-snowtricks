<?php

namespace App\Form\Handler;

use App\Entity\Trick;
use Symfony\Component\Form\FormInterface;

class AddCommentHandler
{
    public function handle(FormInterface $form, Trick $trick): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            return true;
        }

        return false;
    }
}