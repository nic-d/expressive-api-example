<?php

declare(strict_types=1);

namespace User\Hydrator;

use User\Entity\User;
use Zend\Hydrator\Strategy;
use Zend\Hydrator\ReflectionHydrator;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

/**
 * Class UserHydrator
 * @package User\Hydrator
 */
class UserHydrator extends ReflectionHydrator
{
    /**
     * @param object $object
     * @return array
     */
    public function extract($object) : array
    {
        if (! $object instanceof User) {
            return [];
        }

        $this->setNamingStrategy(new UnderscoreNamingStrategy());
        $this->addStrategies();

        return parent::extract($object);
    }

    /**
     * @return void
     */
    private function addStrategies() : void
    {
        // @todo declare some strategies for handling createdAt and updatedAt
    }
}
