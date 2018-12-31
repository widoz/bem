<?php # -*- coding: utf-8 -*-

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
 * Class Service
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class Service implements Value
{
    /**
     * @var Bem
     */
    private $bem;

    /**
     * @var Value
     */
    private $value;

    /**
     * Service constructor
     * @param Bem $bem
     * @param Value $value
     */
    public function __construct(Bem $bem, Value $value)
    {
        $this->bem = $bem;
        $this->value = $value;
    }

    /**
     * @param string $block
     * @return $this
     */
    public function forBlock(string $block): self
    {
        $this->clone($block);

        return $this;
    }

    /**
     * @param string $element
     * @return $this
     */
    public function forElement(string $element): self
    {
        $this->clone('', $element);

        return $this;
    }

    /**
     * @param array $modifiers
     * @return $this
     */
    public function withModifiers(array $modifiers): self
    {
        $this->clone('', '', $modifiers);

        return $this;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value->value();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value->__toString();
    }

    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
     */
    private function clone(string $block = '', string $element = '', array $modifiers = [])
    {
        $bemClass = get_class($this->bem);
        $valueClass = get_class($this->value);

        $newBlock = $block ?: $this->bem->block();
        $newElement = $element ?: $this->bem->element();
        $newBlockModifiers = $modifiers
            ? new BlockModifiers($modifiers, $newBlock)
            : $this->bem->modifiers();

        if ($block) {
            $blockArrayModifiers = iterator_to_array($this->bem->modifiers());
            $newBlockModifiers = $blockArrayModifiers
                ? new BlockModifiers($blockArrayModifiers, $newBlock)
                : new NullModifiers();
        }

        $this->bem = new $bemClass($newBlock, $newElement, $newBlockModifiers);
        $this->value = new $valueClass($this->bem);
    }
}
