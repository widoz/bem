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

use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

/**
 * Standard Factory
 */
class StandardFactory implements Factory
{
    /**
     * @var RemoveCapableHookDispatcher
     */
    private $removeCapableHookDispatcher;

    /**
     * StandardFactory constructor.
     * @param RemoveCapableHookDispatcher $removeCapableHookDispatcher
     */
    public function __construct(RemoveCapableHookDispatcher $removeCapableHookDispatcher)
    {
        $this->removeCapableHookDispatcher = $removeCapableHookDispatcher;
    }

    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
     * @return Standard
     */
    public function create(string $block, string $element = '', array $modifiers = []): Valuable
    {
        $blockModifiers = $modifiers ? new BlockModifiers($modifiers, $block) : new NullModifiers();
        $bem = new Data($block, $element, $blockModifiers);

        return new Standard($bem, $this->removeCapableHookDispatcher);
    }

    /**
     * @param string $block
     * @return Service
     */
    public function createService(string $block): Service
    {
        $bem = new Data($block);
        $value = new Standard($bem, $this->removeCapableHookDispatcher);

        return new Service($bem, $value, $this->removeCapableHookDispatcher);
    }
}
