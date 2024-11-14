<?php

declare(strict_types=1);

namespace Widoz\Bem;

use IteratorAggregate;

/**
 * @template TValue
 * @template-extends IteratorAggregate<array-key, TValue>
 */
interface Modifiers extends IteratorAggregate, Stringable
{
}
