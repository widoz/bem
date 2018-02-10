<?php
declare(strict_types=1);

/**
 * BemPrefixed
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Unprefix\Bem
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

namespace Unprefix\Bem;

/**
 * Class BemPrefixed
 *
 * @since   1.0.0
 * @package Unprefix\Bem
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
final class BemPrefixed implements Bem, Prefix
{
    /**
     * Block
     *
     * @since 1.0.0
     *
     * @var string The block part of the attribute string
     */
    private $block;

    /**
     * Element
     *
     * @since 1.0.0
     *
     * @var string The element part of the attribute string
     */
    private $element;

    /**
     * Modifier
     *
     * @since 1.0.0
     *
     * @var string[] The array contains the modifier strings
     */
    private $modifiers;

    /**
     * The Prefix
     *
     * To avoid conflicts
     *
     * @since 1.0.0
     *
     * @var string The prefix to use in conjunction to the block scope
     */
    private $prefix;

    /**
     * ScopeAttribute constructor
     *
     * @since 1.0.0
     *
     * @param string $block     The block part of the attribute string.
     * @param string $element   The element part of the attribute string.
     * @param array  $modifiers The array contains the modifier strings.
     * @param string $prefix    The prefix to use in conjunction to the block scope.
     */
    public function __construct(
        string $block,
        string $element = '',
        array $modifiers = [],
        string $prefix = ''
    ) {
        $this->block     = $block;
        $this->element   = $element;
        $this->modifiers = $modifiers;
        $this->prefix    = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function value(): string
    {
        // The Scope prefix.
        $scope = $this->prefix . $this->block;

        // Apply the modifiers.
        if ($this->modifiers) {
            $scope = $this->applyModifierToScope($scope);
        }

        // Apply the element.
        if (! $this->modifiers and $this->element) {
            $scope .= "__{$this->element}";
        }

        // Allow to be used outside of WordPress.
        if (function_exists('apply_filters')) {
            /**
             * Scope Filter
             *
             * Filter the scope string before it is returned.
             *
             * @since 1.0.0
             *
             * @param string $scope The scope prefix. Default 'upx'.
             * @param Bem    $this  The instance of the class.
             */
            $scope = apply_filters('unprefix_scope_attribute', $scope, $this);
        }

        // Sanitize the class name.
        $scope = $this->sanitizeHtmlClass($scope);
        // Clean multiple spaces.
        $scope = preg_replace('/\s{2,}/', ' ', $scope);

        return $scope;
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
        return $this->scope();
    }

    /**
     * Apply Modifier to Scope
     *
     * @since 1.0.0
     *
     * @param string $scope The scope to which apply the modifiers.
     *
     * @return string The new scope
     */
    private function applyModifierToScope(string $scope): string
    {
        $scopeModified = array_reduce(
            $this->modifiers,
            function (string $carry, string $item) use ($scope): string {
                // Sanitize modifier.
                $item = preg_replace('/[^a-z0-9\-]/', '-', $item);

                if ($item) {
                    $carry .= ' ' . $scope . "--{$item}";
                }

                return $carry;
            },
            $scope
        );

        // Normalize spaces.
        $scope = preg_replace('/\s{2,}/', ' ', $scopeModified);

        return $scope;
    }

    /**
     * Sanitize Html Class
     *
     * The fallback code is partially get from WordPress `sanitize_html_class` function.
     *
     * @since 1.0.0
     *
     * @param string $class The class string to sanitize.
     *
     * @return string The sanitize html class string
     */
    private function sanitizeHtmlClass(string $class): string
    {
        $classes = explode(' ', $class);

        if (function_exists('sanitize_html_class')) {
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
