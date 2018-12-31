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
 * Class Standard
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
class Standard implements Value
{
    use FilterTrait;

    const FILTER_VALUE = 'bem.value';

    /**
     * @var Bem
     */
    private $bem;

    /**
     * Standard constructor
     * @param Bem $bem
     */
    public function __construct(Bem $bem)
    {
        $this->bem = $bem;
    }

    /**
     * @inheritdoc
     */
    public function value(): string
    {
        // The Scope prefix.
        $block = $this->bem->block();
        $bem = $block;
        $element = $this->bem->element();
        $modifiers = $this->bem->modifiers()->stringify();

        // Apply the modifiers.
        if ($modifiers) {
            $bem .= " {$modifiers}";
        }

        // Apply the element.
        if ($element && !$modifiers) {
            $bem .= "__{$element}";
        }

        $bem = $this->applyFilters($bem, self::FILTER_VALUE);
        // Sanitize the class name.
        $bem = $this->sanitizeHtmlClass($bem);
        // Clean multiple spaces.
        $bem = preg_replace('/\s{2,}/', ' ', $bem);

        return $bem;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->value();
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
