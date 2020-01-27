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

trait ClassAllowedCharsHelper
{
    /**
     * @param array $strings
     * @return array
     */
    private function ensureArrayOfClassesStrings(array $strings): array
    {
        array_walk($strings, [$this, 'ensureStringClass']);

        return $strings;
    }

    /**
     * @param string $string
     * @return string
     * @throws \InvalidArgumentException
     */
    private function ensureStringClass(string $string): string
    {
        if (preg_match('/[^a-zA-Z0-9\-\_]/', $string) > 0) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Key "%s" is not in a allowed format. Please make it compliant with the regexp [a-zA-z0-9\-\_]',
                    $string
                )
            );
        }

        return $string;
    }
}
