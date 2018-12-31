<?php
declare(strict_types=1);

/**
 * Namespaced
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Widoz\Bem
 * @copyright Copyright (c) 2017, Guido Scialfa
 * @license   GNU General Public License, version 2
 *
 * Copyright (C) 2017 Guido Scialfa <dev@guidoscialfa.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Widoz\Bem;

/**
 * Class Namespaced
 *
 * @package Widoz\Bem
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class Namespaced implements Valuable
{
    use FilterTrait;

    const FILTER_VALUE = 'bem.namespaced_value';

    /**
     * @var Valuable The object to decorate
     */
    private $value;

    /**
     * The Prefix
     *
     * To avoid conflicts
     *
     * @var string The prefix to use in conjunction to the block value
     */
    private $namespace;

    /**
     * BemPrefixed constructor
     *
     * @param Valuable $value The value object to decorate
     * @param string $namespace The namespace to use in conjunction to the block value.
     */
    public function __construct(Valuable $value, string $namespace)
    {
        $this->value = $value;
        $this->namespace = $namespace;
    }

    /**
     * @inheritdoc
     */
    public function value(): string
    {
        $bem = $this->applyFilters(
            $this->namespace . $this->value->value(),
            self::FILTER_VALUE
        );

        return $bem;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
