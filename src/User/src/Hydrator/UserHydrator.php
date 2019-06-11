<?php

declare(strict_types=1);

namespace User\Hydrator;

use User\Entity\User;
use Zend\Hydrator\Strategy;
use Zend\Hydrator\ReflectionHydrator;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

use function in_array;

/**
 * Class UserHydrator
 * @package User\Hydrator
 */
class UserHydrator extends ReflectionHydrator
{
    /** @var array $ignoredProperties */
    private $ignoredProperties = ['password'];

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
        $this->addFilters();
        $this->addStrategies();

        return parent::extract($object);
    }

    /**
     * @return void
     */
    private function addFilters() : void
    {
        $this->addFilter('ignoredProperties', function ($property) {
            if (in_array($property, $this->ignoredProperties)) {
                return false;
            }

            return true;
        });
    }

    /**
     * @return void
     */
    private function addStrategies() : void
    {
        // @todo declare some strategies for handling createdAt and updatedAt
    }
}
