<?php # -*- coding: utf-8 -*-
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

interface Valuable
{
    /**
     * Get Value
     *
     * @return string The class attribute value
     */
    public function value(): string;

    /**
     * To String
     *
     * @return string The scope string value
     */
    public function __toString(): string;
}
