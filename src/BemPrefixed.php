<?php
declare(strict_types=1);

/**
 * BemPrefixed
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Widoz\Bem
 * @copyright Copyright (c) 2017, Guido Scialfa
 * @license   GNU General Public License, version 2
 *
 * Copyright (C) 2017 Guido Scialfa <dev@guidoscialfa.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Widoz\Bem;

/**
 * Class BemPrefixed
 *
 * @package Widoz\Bem
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
final class BemPrefixed implements Bem, HasPrefix
{
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
     * @var string[] The array contains the modifier strings
     */
    private $modifiers;

    /**
     * The Prefix
     *
     * To avoid conflicts
     *
     * @var string The prefix to use in conjunction to the block value
     */
    private $prefix;

    /**
     * BemPrefixed constructor
     *
     * @param string $block The block part of the attribute string.
     * @param string $element The element part of the attribute string.
     * @param array $modifiers The array contains the modifier strings.
     * @param string $prefix The prefix to use in conjunction to the block value.
     */
    public function __construct(
        string $block,
        string $element = '',
        array $modifiers = [],
        string $prefix = ''
    ) {

        $this->block = $block;
        $this->element = $element;
        $this->modifiers = $modifiers;
        $this->prefix = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function value(): string
    {
        // The Scope prefix.
        $bem = $this->prefix . $this->block;

        // Apply the modifiers.
        if ($this->modifiers) {
            $bem = $this->applyModifierToValue($bem);
        }

        // Apply the element.
        if (!$this->modifiers and $this->element) {
            $bem .= "__{$this->element}";
        }

        // Allow to be used outside of WordPress.
        if (\function_exists('apply_filters')) {
            /**
             * Bem Filter
             *
             * Filter the value string before it is returned.
             *
             * @param string $bem The bem value.
             * @param Bem $this The instance of the class.
             */
            $bem = apply_filters('bem', $bem, $this);
        }

        // Sanitize the class name.
        $bem = $this->sanitizeHtmlClass($bem);
        // Clean multiple spaces.
        $bem = preg_replace('/\s{2,}/', ' ', $bem);

        return $bem;
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
    public function modifiers(): array
    {
        return $this->modifiers;
    }

    /**
     * @inheritdoc
     */
    public function prefix(): string
    {
        return $this->prefix;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * Apply Modifier to Scope
     *
     * @param string $value The value to which apply the modifiers.
     *
     * @return string The new bem value
     */
    private function applyModifierToValue(string $value): string
    {
        $scopeModified = array_reduce(
            $this->modifiers,
            function (string $carry, string $item) use ($value): string {
                // Sanitize modifier.
                $item = preg_replace('/[^a-z0-9\-]/', '-', $item);

                if ($item) {
                    $carry .= ' ' . $value . "--{$item}";
                }

                return $carry;
            },
            $value
        );

        // Normalize spaces.
        $value = preg_replace('/\s{2,}/', ' ', $scopeModified);

        return $value;
    }

    /**
     * Sanitize Html Class
     *
     * The fallback code is partially get from WordPress `sanitize_html_class` function.
     *
     * @param string $class The class string to sanitize.
     *
     * @return string The sanitize html class string
     */
    private function sanitizeHtmlClass(string $class): string
    {
        $classes = explode(' ', $class);

        if (\function_exists('sanitize_html_class')) {
            return implode(' ', array_map('sanitize_html_class', $classes));
        }

        $classes = array_map(function (string $class): string {
            // Strip out any % encoded octets.
            // Limit to A-Z,a-z,0-9,_,-.
            return preg_replace(
                '/[^A-Za-z0-9_-]/',
                '',
                preg_replace('|%[a-fA-F0-9][a-fA-F0-9]|', '', $class)
            );
        }, $classes);

        return implode(' ', $classes);
    }
}
