<?php

declare(strict_types=1);

namespace Util\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Timestamp
 * @package Util\Traits
 */
trait Timestamp
{
    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", columnDefinition="DATETIME DEFAULT CURRENT_TIMESTAMP")
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", columnDefinition="DATETIME on UPDATE CURRENT_TIMESTAMP")
     */
    private $updatedAt;

    # ---------------------------------------------------------------
    # - GETTERS AND SETTERS
    # ---------------------------------------------------------------

    /**
     * @return DateTime|null
     */
    public function getCreatedAt() : ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return self
     */
    public function setCreatedAt(?DateTime $createdAt) : self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt() : ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return self
     */
    public function setUpdatedAt(?DateTime $updatedAt) : self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
