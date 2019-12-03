<?php

namespace App\Core\Application\Service;

use App\Core\Domain\Model\User\User;
use App\Core\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        UserRepositoryInterface $repository,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }

    public function create(
        string $email,
        string $firstname,
        string $lastname,
        string $password
    ): User {
        $user = new User();
        $user->setEmail($email);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setActive(true);
        $user->setPassword($this->encoder->encodePassword($user, $password));

        $this->repository->add($user);

        return $user;
    }
}
