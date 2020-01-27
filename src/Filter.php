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

use function apply_filters_ref_array;
use function function_exists;

/**
 * Class Filter
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class Filter
{
    /**
     * @param string $bem
     * @param string $filter
     * @return string
     */
    public function apply(string $bem, string $filter): string
    {
        // Allow to be used outside of WordPress.
        if (function_exists('apply_filters_ref_array')) {
            /**
             * Bem Filter
             *
             * Filter the value string before it is returned.
             *
             * @param string $filter The hook name.
             * @param array{string, Valuable} $ref_array The bem value and the instance of this class.
             */
            $bem = (string)apply_filters_ref_array($filter, [$bem, $this]);
        }

        return $bem;
    }
}
