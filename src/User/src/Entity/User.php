<?php

declare(strict_types=1);

namespace User\Entity;

use DateTime;
use Util\Traits\Uuid;
use Util\Traits\Timestamp;
use Util\Traits\ObjectToArray;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 *
 * Class User
 * @package User\Entity
 */
class User
{
    use Uuid, Timestamp, ObjectToArray;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime('now');
        $this->updatedAt = new DateTime('now');
    }

    /**
     * @ORM\Column(name="email", type="string", length=250, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", length=250)
     */
    private $password;

    # ---------------------------------------------------------------
    # - GETTERS AND SETTERS
    # ---------------------------------------------------------------

    /**
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password) : self
    {
        $this->password = $password;
        return $this;
    }
}
