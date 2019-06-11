<?php

declare(strict_types=1);

namespace User\Exception;

use DomainException;
use function sprintf;

/**
 * Class UserNotFoundException
 * @package User\Exception
 */
class UserNotFoundException extends DomainException
{
    /**
     * @param $id
     * @return UserNotFoundException
     */
    public static function forId($id) : self
    {
        $message = sprintf('User not found with Id %s', $id);
        $code    = 404;

        return new self($message, $code);
    }
}
