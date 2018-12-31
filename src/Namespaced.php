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
