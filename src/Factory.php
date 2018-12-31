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

class Factory
{
    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
     * @return Standard
     */
    public static function createStandard(
        string $block,
        string $element = '',
        array $modifiers = []
    ): Standard {

        $blockModifiers = self::createModifiers($modifiers, $block);
        $data = new Data($block, $element, $blockModifiers);

        return new Standard($data);
    }

    /**
     * @param string $namespace
     * @param string $block
     * @param string $element
     * @param array $modifiers
     * @return Namespaced
     */
    public static function createWithNamespace(
        string $namespace,
        string $block,
        string $element = '',
        array $modifiers = []
    ): Namespaced {

        $bem = self::createStandard($namespace . $block, $element, $modifiers);

        return new Namespaced($bem, $namespace);
    }

    /**
     * @param array $modifiers
     * @param string $block
     * @return Modifiers
     */
    private static function createModifiers(array $modifiers, string $block): Modifiers
    {
        return $modifiers ? new BlockModifiers($modifiers, $block) : new NullModifiers();
    }
}
