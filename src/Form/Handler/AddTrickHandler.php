<?php

namespace App\Form\Handler;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use App\Builder\Trick\AddTrickBuilder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddTrickHandler
{
    private $addTrickBuilder;
    private $validatorInterface;

    public function __construct(
        AddTrickBuilder $addTrickBuilder,
        ValidatorInterface $validatorInterface
    )
    {
        $this->addTrickBuilder = $addTrickBuilder;
        $this->validatorInterface = $validatorInterface;
    }

    /**
     * @param FormInterface $form
     * @return bool
     * @throws \Exception
     */
    public function handle(FormInterface $form): bool
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $trick = $this->addTrickBuilder->create($form->getData());

            $errors = $this->validatorInterface->validate($trick);

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    if ($error->getPropertyPath() == 'title') {
                        $form->get('title')->addError(new FormError($error->getMessage()));
                    }
                }

                return false;
            }



            return true;
        }

        return false;
    }
}