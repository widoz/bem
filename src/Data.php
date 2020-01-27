<?php
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

use InvalidArgumentException;

class Data implements Bem
{
    use ClassAllowedCharsHelper;

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
     * Modifiers
     *
     * @var Modifiers|null The array contains the modifier strings
     */
    private $modifiers;

    /**
     * Data constructor
     *
     * @param string $block
     * @param string $element
     * @param Modifiers|null $modifiers
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $block, string $element = '', Modifiers $modifiers = null)
    {
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
    public function modifiers(): Modifiers
    {
        return $this->modifiers ?: new NullModifiers();
    }
}
