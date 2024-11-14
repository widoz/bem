<?php

declare(strict_types=1);

namespace Widoz\Bem;

use ArrayIterator;

/**
 * @template-implements Modifiers<string>
 */
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
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator([]);
    }
}
