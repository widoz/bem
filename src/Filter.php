<?php

declare(strict_types=1);

namespace Widoz\Bem;

use function apply_filters_ref_array;
use function function_exists;

class Filter
{
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
             * @param array{string, Valuable} $ref_array The bem value and the
             * instance of this class.
             */
            $bem = (string)apply_filters_ref_array($filter, [$bem, $this]);
        }

        return $bem;
    }
}
