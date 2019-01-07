<?php

namespace App\Form\Handler;

use App\Builder\User\UpdateAvatarUserBuilder;
use App\Entity\User;
use App\Repository\AvatarRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use App\Service\AvatarDelete;

class UpdateAvatarHandler
{
    /**
     * @var AvatarDelete
     */
    private $avatarDelete;

    /**
     * @var UpdateAvatarUserBuilder
     */
    private $avatarUserBuilder;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var AvatarRepository
     */
    private $avatarRepository;

    /**
     * UpdateAvatarHandler constructor.
     * @param AvatarDelete $avatarDelete
     * @param UpdateAvatarUserBuilder $avatarUserBuilder
     * @param UserRepository $userRepository
     * @param AvatarRepository $avatarRepository
     */
    public function __construct(
        AvatarDelete $avatarDelete,
        UpdateAvatarUserBuilder $avatarUserBuilder,
        UserRepository $userRepository,
        AvatarRepository $avatarRepository
    )
    {
        $this->avatarDelete = $avatarDelete;
        $this->avatarUserBuilder = $avatarUserBuilder;
        $this->userRepository = $userRepository;
        $this->avatarRepository = $avatarRepository;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return bool
     * @throws \Exception
     */
    public function handle(FormInterface $form, User $user)
    {
        if ($form->isSubmitted() && $form->isValid())
        {
            //supprimer le fichier
            $oldAvatar = $user->getAvatar();
            $this->avatarDelete->delete($oldAvatar);

            //ajoute nouveau fichier dans le repertoir uploads/images
            $newAvatar = $this->avatarUserBuilder->updateAvatar($form->getData());
            $user->updateAvatar($newAvatar);

            //MAJ de la BDD
            $this->userRepository->save();
            $this->avatarRepository->remove($oldAvatar);

            return true;
        }

        return false;
    }
}