<?php

declare(strict_types=1);

namespace Widoz\Bem;

use ArrayIterator;

class BlockModifiers implements Modifiers
{
    use ClassAllowedCharsHelper;

    /**
     * @var array
     */
    private $modifiers;

    /**
     * @var string
     */
    private $block;

    /**
     * BlockModifiers constructor
     * @param array $modifiers
     * @param string $block
     */
    public function __construct(array $modifiers, string $block)
    {
        $this->modifiers = $this->ensureArrayOfClassesStrings($modifiers);
        $this->block = $block;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new ArrayIterator($this->modifiers);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $scopeModified = array_reduce($this->modifiers, [$this, 'reduce'], '');
        $value = (string)preg_replace('/\s{2,}/', ' ', $scopeModified);

        return trim($value);
    }

    /**
     * @param string $carry
     * @param string $item
     * @return string
     */
    private function reduce(string $carry, string $item): string
    {
        $carry .= ' ' . "{$this->block}--{$item}";

        return $carry;
    }
}
