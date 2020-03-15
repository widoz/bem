<?php

declare(strict_types=1);

namespace Widoz\Bem;

use ArrayIterator;

class NullModifiers implements Modifiers
{
    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator([]);
    }
}
