<?php

namespace App\Form\Handler;

use App\Builder\User\ForgottenPasswordBuilder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ForgottenPasswordHandler
{
    /**
     * @var ForgottenPasswordBuilder
     */
    private $forgottenPasswordBuilder;

    private $sessionInterface;

    public function __construct(
        ForgottenPasswordBuilder $forgottenPasswordBuilder,
        SessionInterface $sessionInterface
    )
    {
        $this->forgottenPasswordBuilder = $forgottenPasswordBuilder;
        $this->sessionInterface = $sessionInterface;
    }

    /**
     * @param FormInterface $form
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->forgottenPasswordBuilder->forgotten($form->getData());

            if ($user) {
                $this->sessionInterface->getFlashBag()->add(
                    'fogotten-password-success',
                    'Un e-mail vous a été envoyé pour réinitialiser votre mot de passe.'
                );

                return;
            }
            $this->sessionInterface->getFlashBag()->add(
                'forgotten-password-warning',
                'Aucun utilisateur ne correspond à ce pseudo ou cette e-mail.'
            );

        }
    }
}