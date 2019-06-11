<?php

declare(strict_types=1);

namespace User\Service;

use User\Entity\User;
use User\Hydrator\UserHydrator;
use Doctrine\ORM\EntityManagerInterface;
use User\Exception\UserNotFoundException;

use function is_null;
use function password_hash;

/**
 * Class UserService
 * @package User\Service
 */
class UserService
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /** @var UserHydrator $userHydrator */
    private $userHydrator;

    /**
     * UserService constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserHydrator $userHydrator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserHydrator $userHydrator
    ) {
        $this->entityManager = $entityManager;
        $this->userHydrator = $userHydrator;
    }

    /**
     * @param $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getOneById($id) : User
    {
        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($id);

        if (is_null($user)) {
            throw UserNotFoundException::forId($id);
        }

        return $user;
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data = []) : User
    {
        /** @var User $user */
        $user = $this->userHydrator->hydrate($data, new User());

        // Let's hash the password, can't be storing it in plaintext ;)
        $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function update(User $user, array $data = []) : void
    {
    }

    /**
     * @param User $user
     * @return void
     */
    public function delete(User $user) : void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
