<?php

declare(strict_types=1);

namespace Util\Traits;

use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Uuid
 * @package Util\Traits
 */
trait Uuid
{
    /**
     * @var UuidInterface|null
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    # ---------------------------------------------------------------
    # - GETTERS AND SETTERS
    # ---------------------------------------------------------------

    /**
     * @return UuidInterface|null
     */
    public function getId() : ?UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface|null $id
     * @return self
     */
    public function setId(?UuidInterface $id) : self
    {
        $this->id = $id;
        return $this;
    }
}
