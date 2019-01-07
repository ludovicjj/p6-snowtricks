<?php

namespace App\Form\Handler;

use App\Builder\User\ForgottenPasswordBuilder;
use App\Service\Mailer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ForgottenPasswordHandler
{
    /**
     * @var ForgottenPasswordBuilder
     */
    private $forgottenPasswordBuilder;

    /**
     * @var SessionInterface
     */
    private $sessionInterface;

    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(
        ForgottenPasswordBuilder $forgottenPasswordBuilder,
        SessionInterface $sessionInterface,
        Mailer $mailer
    )
    {
        $this->forgottenPasswordBuilder = $forgottenPasswordBuilder;
        $this->sessionInterface = $sessionInterface;
        $this->mailer = $mailer;
    }

    /**
     * @param FormInterface $form
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->forgottenPasswordBuilder->forgotten($form->getData());

            if ($user) {
                $this->mailer->sendMail($user, 'Réinitialiser mot de passe', 'forgotten');
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