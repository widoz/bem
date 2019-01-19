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

class Standard implements Valuable
{
    const FILTER_VALUE = 'bem.value';

    /**
     * @var Bem
     */
    private $bem;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * Standard constructor
     * @param Bem $bem
     * @param Filter $filter
     */
    public function __construct(Bem $bem, Filter $filter)
    {
        $this->bem = $bem;
        $this->filter = $filter;
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
        $modifiers = $this->bem->modifiers()->stringify();

        // Apply the modifiers.
        if ($modifiers) {
            $bem .= " {$modifiers}";
        }

        // Apply the element.
        if ($element && !$modifiers) {
            $bem .= "__{$element}";
        }

        $bem = $this->filter->apply($bem, self::FILTER_VALUE);
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
