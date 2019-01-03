<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Brain\Monkey\Functions;
use Widoz\Bem\Data;
use Widoz\Bem\BlockModifiers;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;

class StandardTest extends TestCase
{
    public function testToString()
    {
        $bem = new Data('block', 'element');
        $testee = new Standard($bem);

        echo $testee;

        self::expectOutputString('block__element');
    }

    public function testElement()
    {
        $bem = new Data('block', 'element');
        $testee = new Standard($bem);

        $response = $testee->value();

        self::assertSame('block__element', $response);
    }

    public function testModifierOverrideElement()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $testee = new Standard($bem);

        Functions\when('apply_filters')
            ->returnArg(2);

        $scope = $testee->value();

        $this->assertSame('block block--modifier', $scope);
    }

    public function testSanitizeHtmlClassKeepOnlyOneSpaceBetweenClasses()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->alias(function () {
                return 'block  block--modifier  block--modifier-2';
            });
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $modifiers = new BlockModifiers(
            [
                'modifier',
                'modifier-2',
            ],
            'block'
        );
        $bem = new Data('block', 'element', $modifiers);
        $testee = new Standard($bem);

        $response = $testee->value();

        $this->assertSame('block block--modifier block--modifier-2', $response);
    }
}
