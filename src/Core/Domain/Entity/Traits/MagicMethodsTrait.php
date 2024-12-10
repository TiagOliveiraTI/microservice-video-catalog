<?php

declare(strict_types=1);

namespace Core\Domain\Entity\Traits;

use Exception;

trait MagicMethodsTrait
{
    /**
     * @throws Exception
     */
    public function __get(string $property): mixed
    {
        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);

        throw new Exception("Property $property not found in class $className");
    }
}