<?php

declare(strict_types=1);

namespace Widoz\Bem;

use InvalidArgumentException;

trait StandardFactoryHelper
{
    /**
     * @param array<string> $modifiers
     *
     * @throws InvalidArgumentException
     * @return Standard
     */
    private function createStandard(
        string $block,
        string $element = '',
        array $modifiers = []
    ): Standard {

        $blockModifiers = $modifiers ? new BlockModifiers($modifiers, $block) : new NullModifiers();
        $bem = new Data($block, $element, $blockModifiers);
        $filter = new Filter();

        return new Standard($bem, $filter);
    }

    /**
     * @throws InvalidArgumentException
     */
    private function createServiceForStandard(string $block): Service
    {
        $bem = new Data($block);
        $filter = new Filter();
        $value = new Standard($bem, $filter);

        return new Service($bem, $value, $filter);
    }
}
