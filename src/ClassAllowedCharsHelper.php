<?php

declare(strict_types=1);

namespace Widoz\Bem;

use InvalidArgumentException;

trait ClassAllowedCharsHelper
{
    /**
     * @param array<string> $strings
     * @return array<string>
     * @psalm-assert array<string> $strings
     */
    private function ensureArrayOfClassesStrings(array $strings): array
    {
        foreach ($strings as &$string) {
            $string = $this->ensureStringClass($string);
        }

        return $strings;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function ensureStringClass(string $string): string
    {
        if (preg_match('/[^a-zA-Z0-9\-\_]/', $string) > 0) {
            throw new InvalidArgumentException(
                sprintf(
                    // phpcs:ignore Inpsyde.CodeQuality.LineLength.TooLong
                    'Key "%s" is not in a allowed format. Please make it compliant with the regexp [a-zA-z0-9\-\_]',
                    $string
                )
            );
        }

        return $string;
    }
}
