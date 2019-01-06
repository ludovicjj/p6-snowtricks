<?php

namespace App\Form\Handler;

use App\Builder\User\RegistrationUserBuilder;
use App\Repository\UserRepository;
use App\Service\Mailer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\FormError;

class RegistrationUserHandler
{
    /**
     * @var RegistrationUserBuilder
     */
    private $registrationUserBuilder;

    /**
     * @var ValidatorInterface
     */
    private $validatorInterface;

    /**
     * @var UserRepository
     */
    private $userRepository;

    private $mailer;
    private $sessionInterface;

    public function __construct(
        RegistrationUserBuilder $registrationUserBuilder,
        ValidatorInterface $validatorInterface,
        UserRepository $userRepository,
        Mailer $mailer,
        SessionInterface $sessionInterface
    )
    {
        $this->registrationUserBuilder = $registrationUserBuilder;
        $this->validatorInterface = $validatorInterface;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
        $this->sessionInterface = $sessionInterface;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Exception
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->registrationUserBuilder->registration($form->getData());

            $errors = $this->validatorInterface->validate($user);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    if ($error->getPropertyPath() == 'username') {
                        $form->get('username')->addError(new FormError($error->getMessage()));
                    }
                    elseif ($error->getPropertyPath() == 'email') {
                        $form->get('email')->addError(new FormError($error->getMessage()));
                    }
                }

                return false;
            }

            $this->userRepository->persists($user);
            $this->mailer->sendMail($user, 'Inscription', 'registration');
            $this->sessionInterface->getFlashBag()->add(
                'registration-user-success',
                ' Un email vous a été envoyé pour activer votre compte à l\'adresse suivant : '.$form->getData()->email
            );

            return true;
        }

        return false;
    }
}