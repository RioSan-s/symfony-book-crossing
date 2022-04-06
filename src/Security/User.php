<?php

namespace NonEfTech\BookCrossing\Security;
use NonEfTech\BookCrossing\Entity\Administrator as AdminFromDomain;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Обертка над пользователем
 */
final class User implements
    UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var AdminFromDomain - Пользователь из домена приложения
     */
    public AdminFromDomain $user;

    /**
     *
     * @param AdminFromDomain $user - Пользователь из домена приложения
     */
    public function __construct(AdminFromDomain $user)
    {
        $this->user = $user;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return [
            UserRoleInterface::ROLE_AUTH_USER,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {
        return $this->user->getPassword();
    }

    /**
     * @inheritDocдо
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername(): string
    {
        return $this->user->getLogin();
    }

    public function getUserIdentifier(): string
    {
        return $this->user->getLogin();
    }

}