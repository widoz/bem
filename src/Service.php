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

class Service
{
    /**
     * @var Bem
     */
    private $bem;

    /**
     * @var Valuable
     */
    private $value;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * Service constructor
     * @param Bem $bem
     * @param Valuable $value
     */
    public function __construct(Bem $bem, Valuable $value, Filter $filter)
    {
        $this->bem = $bem;
        $this->value = $value;
        $this->filter = $filter;
    }

    /**
     * @return Valuable
     */
    public function value(): Valuable
    {
        return $this->value;
    }

    /**
     * @param string $element
     * @return Valuable
     */
    public function forElement(string $element): Valuable
    {
        return $this->clone($element);
    }

    /**
     * @param array $modifiers
     * @return Valuable
     */
    public function withModifiers(array $modifiers): Valuable
    {
        return $this->clone('', $modifiers);
    }

    /**
     * @param string $element
     * @param array $modifiers
     * @return Valuable
     */
    private function clone(string $element = '', array $modifiers = []): Valuable
    {
        $bemClass = get_class($this->bem);
        $valueClass = get_class($this->value);

        $block = $this->bem->block();
        $newElement = $element ?: $this->bem->element();
        $newBlockModifiers = $modifiers
            ? new BlockModifiers($modifiers, $block)
            : $this->bem->modifiers();

        $bem = new $bemClass($block, $newElement, $newBlockModifiers);

        return new $valueClass($bem, $this->filter);
    }
}
