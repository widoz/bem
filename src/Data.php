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

/**
 * Class Data
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class Data implements Bem
{
    use ClassAllowedCharsTrait;

    /**
     * Block
     *
     * @var string The block part of the attribute string
     */
    private $block;

    /**
     * Element
     *
     * @var string The element part of the attribute string
     */
    private $element;

    /**
     * Modifier
     *
     * @var BlockModifiers The array contains the modifier strings
     */
    private $modifiers;

    /**
     * Data constructor
     * @param string $block
     * @param string $element
     * @param Modifiable|null $modifiers
     */
    public function __construct(
        string $block,
        string $element = '',
        Modifiable $modifiers = null
    ) {

        $this->block = $this->ensureStringClass($block);
        $this->element = $this->ensureStringClass($element);
        $this->modifiers = $modifiers;
    }

    /**
     * @inheritdoc
     */
    public function block(): string
    {
        return $this->block;
    }

    /**
     * @inheritdoc
     */
    public function element(): string
    {
        return $this->element;
    }

    /**
     * @inheritdoc
     */
    public function modifiers(): Modifiable
    {
        return $this->modifiers ?: new NullModifiers();
    }
}
