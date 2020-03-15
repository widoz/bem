<?php

declare(strict_types=1);

namespace Widoz\Bem;

interface Bem
{
    /**
     * Block
     *
     * @return string The block part
     */
    public function block(): string;

    /**
     * Element
     *
     * @return string The element part
     */
    public function element(): string;

    /**
     * Modifiers
     *
     * @return Modifiers The modifiers list
     */
    public function modifiers(): Modifiers;
}
