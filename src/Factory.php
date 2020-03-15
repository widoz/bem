<?php

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
