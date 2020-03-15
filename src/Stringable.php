<?php

declare(strict_types=1);

namespace Widoz\Bem;

/**
 * Class Stringable
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
interface Stringable
{
    /**
     * @return string
     */
    public function __toString(): string;
}
