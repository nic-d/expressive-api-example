<?php

declare(strict_types=1);

namespace Util\Traits;

use function get_object_vars;

/**
 * Class ObjectToArray
 * @package Util\Traits
 */
trait ObjectToArray
{
    /**
     * @return array
     */
    public function getArrayCopy() : array
    {
        return get_object_vars($this);
    }
}
