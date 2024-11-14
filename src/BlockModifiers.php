<?php

declare(strict_types=1);

namespace Widoz\Bem;

use ArrayIterator;

/**
 * @template-implements Modifiers<string>
 */
class BlockModifiers implements Modifiers
{
    use ClassAllowedCharsHelper;

    /**
     * @var array<string>
     */
    private $modifiers;

    private string $block;

    /**
     * @param array<string> $modifiers
     */
    public function __construct(array $modifiers, string $block)
    {
        $this->modifiers = $this->ensureArrayOfClassesStrings($modifiers);
        $this->block = $block;
    }

    public function getIterator(): \Traversable
    {
        return new ArrayIterator($this->modifiers);
    }

    public function __toString(): string
    {
        $scopeModified = array_reduce($this->modifiers, [$this, 'reduce'], '');
        $value = (string)preg_replace('/\s{2,}/', ' ', $scopeModified);

        return trim($value);
    }

    private function reduce(string $carry, string $item): string
    {
        $carry .= ' ' . "{$this->block}--{$item}";

        return $carry;
    }
}
