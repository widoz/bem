<?php

declare(strict_types=1);

namespace Widoz\Bem;

interface Valuable extends Stringable
{
    public function value(): string;
}
