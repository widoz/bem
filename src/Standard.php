<?php # -*- coding: utf-8 -*-
/*
 * This file is part of the Bem package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Widoz\Bem;

use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

class Standard implements Valuable
{
    const FILTER_VALUE = 'bem.value';

    /**
     * @var Bem
     */
    private $bem;

    /**
     * @var RemoveCapableHookDispatcher
     */
    private $removeCapableHookDispatcher;

    /**
     * Standard constructor
     * @param Bem $bem
     * @param RemoveCapableHookDispatcher $removeCapableHookDispatcher
     */
    public function __construct(Bem $bem, RemoveCapableHookDispatcher $removeCapableHookDispatcher)
    {
        $this->bem = $bem;
        $this->removeCapableHookDispatcher = $removeCapableHookDispatcher;
    }

    /**
     * @inheritdoc
     */
    public function value(): string
    {
        // The Scope prefix.
        $block = $this->bem->block();
        $bem = $block;
        $element = $this->bem->element();
        $modifiers = (string)$this->bem->modifiers();

        // Apply the modifiers.
        if ($modifiers) {
            $bem .= " {$modifiers}";
        }

        // Apply the element.
        if ($element && !$modifiers) {
            $bem .= "__{$element}";
        }

        $bem = ($this->removeCapableHookDispatcher)(self::FILTER_VALUE, $bem);
        // Clean multiple spaces.
        $bem = preg_replace('/\s{2,}/', ' ', $bem);

        return $bem;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
