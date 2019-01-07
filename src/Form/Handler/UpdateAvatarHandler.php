<?php

namespace App\Form\Handler;

use App\Entity\User;
use Symfony\Component\Form\FormInterface;

class UpdateAvatarHandler
{
    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid())
        {

            return true;
        }

        return false;
    }
}