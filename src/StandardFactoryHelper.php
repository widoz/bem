<?php

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

use InvalidArgumentException;

/**
 * Standard Factory Helper
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
trait StandardFactoryHelper
{
    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
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
     * @param string $block
     *
     * @throws InvalidArgumentException
     * @return Service
     */
    private function createServiceForStandard(string $block): Service
    {
        $bem = new Data($block);
        $filter = new Filter();
        $value = new Standard($bem, $filter);

        return new Service($bem, $value, $filter);
    }
}
