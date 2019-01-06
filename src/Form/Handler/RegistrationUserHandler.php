<?php

namespace App\Form\Handler;

use Symfony\Component\Form\FormInterface;

class RegistrationUserHandler
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            return true;
        }

        return false;
    }
}