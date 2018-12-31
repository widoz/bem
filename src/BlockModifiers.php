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
 * Class Modifier
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class BlockModifiers implements Modifiable
{
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
        $this->ensureModifiers($modifiers);

        $this->modifiers = $modifiers;
        $this->block = $block;
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->modifiers);
    }

    /**
     * @return string
     */
    public function stringify(): string
    {
        $scopeModified = array_reduce($this->modifiers, [$this, 'reduce'], '');
        $value = preg_replace('/\s{2,}/', ' ', $scopeModified);

        return trim($value);
    }

    /**
     * @param string $carry
     * @param string $item
     * @return string
     */
    private function reduce(string $carry, string $item): string
    {
        // Sanitize modifier.
        $item = preg_replace('/[^a-zA-Z0-9\-]/', '-', $item);
        $carry .= ' ' . "{$this->block}--{$item}";

        return $carry;
    }

    /**
     * @param array $modifiers
     * @throws \RuntimeException
     */
    private function ensureModifiers(array $modifiers)
    {
        $modifiers = array_filter($modifiers, 'is_string');
        if (count($modifiers) === 0) {
            throw new \RuntimeException('Modifiers are not strings.');
        }
    }
}
