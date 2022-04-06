<?php

namespace NonEfTech\BookCrossing\Security;

use NonEfTech\BookCrossing\Entity\AdministratorRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManagerInterface;

final class UserProvider implements UserProviderInterface
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * Пользователи
     * @var AdministratorRepositoryInterface
     */
    private AdministratorRepositoryInterface $adminRepository;

    /**
     * @param AdministratorRepositoryInterface $adminRepository
     * @param EntityManagerInterface  $em
     */
    public function __construct(AdministratorRepositoryInterface $adminRepository, EntityManagerInterface $em)
    {
        $this->adminRepository = $adminRepository;
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function supportsClass(string $class):bool
    {
        return $class === User::class;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername(string $username)
    {
        return $this->loadUserByIdentifier($username);
    }


    public function loadUserByIdentifier(string $identifier):User
    {
        $adminFromDomain = $this->adminRepository->findUserByLogin($identifier);
        if(null===$adminFromDomain)
        {
            throw new UserNotFoundException("Пользователь не найден $identifier");
        }
        return new User($adminFromDomain);
    }


    public function refreshUser(UserInterface $user):UserInterface
    {
        $adminFromDomain = $this->adminRepository->findUserByLogin($user->getUserIdentifier());
        $this->em->refresh($adminFromDomain);
        return $user;
    }
}