<?php

declare(strict_types=1);

namespace Widoz\Bem;

use InvalidArgumentException;

/**
 * @api
 */
class StandardFactory implements Factory
{
    use StandardFactoryHelper;

    /**
     * @param string $block
     * @param string $element
     * @param array<string> $modifiers
     *
     * @throws InvalidArgumentException
     * @return Standard
     */
    public function create(string $block, string $element = '', array $modifiers = []): Valuable
    {
        return $this->createStandard($block, $element, $modifiers);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function createService(string $block): Service
    {
        return $this->createServiceForStandard($block);
    }
}
