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

/**
 * Interface Factory
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
interface Factory
{
    /**
     * @param string $block
     * @param string $element
     * @param array $modifiers
     * @return Standard
     */
    public function create(string $block, string $element = '', array $modifiers = []): Valuable;

    /**
     * @param string $block
     * @return Service
     */
    public function createService(string $block): Service;
}
