<?php

namespace App\Infrastructure\Security\Provider;

use App\Core\Domain\Model\User\User;
use App\Core\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class SymfonyUserProvider implements UserProviderInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @see UserProviderInterface
     */
    public function loadUserByUsername(string $username)
    {
        return $this->findUser($username);
    }

    /**
     * @see UserProviderInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = $user->getUsername();

        return $this->findUser($username);
    }

    /**
     * @see UserProviderInterface
     */
    public function supportsClass(string $class)
    {
        return User::class === $class;
    }

    /**
     * Get user from username(email).
     *
     * @param string $username (email)
     *
     * @return UserInterface
     */
    private function findUser(string $username): UserInterface
    {
        $user = $this->userRepository->findOneByEmail($username);
        if ($user === null) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return $user;
    }
}
