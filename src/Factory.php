<?php

declare(strict_types=1);

namespace Widoz\Bem;

/**
 * @api
 */
interface Factory
{
    /**
     * @param array<string> $modifiers
     * @return Standard
     */
    public function create(string $block, string $element = '', array $modifiers = []): Valuable;

    /**
     * @return Service
     */
    public function createService(string $block): Service;
}
