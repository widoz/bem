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
 * Class NullModifiers
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class NullModifiers implements Modifiable
{
    /**
     * @inheritdoc
     */
    public function stringify(): string
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator([]);
    }
}
