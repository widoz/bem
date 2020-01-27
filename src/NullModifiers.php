<?php
/*
 * This file is part of the Bem package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
