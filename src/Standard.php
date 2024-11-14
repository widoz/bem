<?php

declare(strict_types=1);

namespace Widoz\Bem;

class Standard implements Valuable
{
    public const FILTER_VALUE = 'bem.value';

    /**
     * @var Bem
     */
    private $bem;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * Standard constructor
     * @param Bem $bem
     * @param Filter $filter
     */
    public function __construct(Bem $bem, Filter $filter)
    {
        $this->bem = $bem;
        $this->filter = $filter;
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
        $modifiers = (string)$this->bem->modifiers();

        // Apply the modifiers.
        if ($modifiers) {
            $bem .= " {$modifiers}";
        }

        // Apply the element.
        if ($element && !$modifiers) {
            $bem .= "__{$element}";
        }

        $bem = $this->filter->apply($bem, self::FILTER_VALUE);
        // Clean multiple spaces.
        $bem = (string)preg_replace('/\s{2,}/', ' ', $bem);

        return $bem;
    }

    /**
     * @inheritdoc
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
