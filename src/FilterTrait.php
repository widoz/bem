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
 * Class FilterTrait
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
trait FilterTrait
{
    /**
     * @param string $bem
     * @param string $filter
     * @return string
     */
    private function applyFilters(string $bem, string $filter): string
    {
        // Allow to be used outside of WordPress.
        if (\function_exists('apply_filters')) {
            /**
             * Bem Filter
             *
             * Filter the value string before it is returned.
             *
             * @param string $bem The bem value.
             * @param Valuable $this The instance of the class.
             */
            $bem = (string)apply_filters($filter, $bem, $this);
        }

        return $bem;
    }
}
