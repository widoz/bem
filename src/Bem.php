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

interface Bem
{
    /**
     * Block
     *
     * @return string The block part
     */
    public function block(): string;

    /**
     * Element
     *
     * @return string The element part
     */
    public function element(): string;

    /**
     * Modifiers
     *
     * @return Modifiers The modifiers list
     */
    public function modifiers(): Modifiers;
}
