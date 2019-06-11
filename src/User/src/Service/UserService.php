<?php

declare(strict_types=1);

namespace User\Service;

use User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use User\Exception\UserNotFoundException;

/**
 * Class UserService
 * @package User\Service
 */
class UserService
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /**
     * UserService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getOneById($id) : User
    {
    }

    public function create(array $data = []) : User
    {
    }

    public function update(User $user, array $data = []) : void
    {
    }

    public function delete(User $user) : void
    {
    }
}
