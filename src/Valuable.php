<?php

declare(strict_types=1);

namespace Widoz\Bem;

interface Valuable extends Stringable
{
    /**
     * Get Value
     *
     * @return string The class attribute value
     */
    public function value(): string;
}
