<?php

declare(strict_types=1);

namespace Widoz\Bem;

use InvalidArgumentException;

/**
 * Standard Factory
 */
class StandardFactory implements Factory
{
    use StandardFactoryHelper;

    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
     *
     * @throws InvalidArgumentException
     * @return Standard
     */
    public function create(string $block, string $element = '', array $modifiers = []): Valuable
    {
        return $this->createStandard($block, $element, $modifiers);
    }

    /**
     * @param string $block
     *
     * @throws InvalidArgumentException
     * @return Service
     */
    public function createService(string $block): Service
    {
        return $this->createServiceForStandard($block);
    }
}
