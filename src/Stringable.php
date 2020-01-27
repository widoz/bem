<?php

/*
 * This file is part of the bem package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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
