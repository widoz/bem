<?php
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\BlockModifiers;
use Widoz\Bem\Data;
use Widoz\Bem\Filter;
use Widoz\Bem\Standard;

use function Brain\Monkey\Functions\when;

class StandardTest extends TestCase
{
    public function testToString()
    {
        $bem = new Data('block', 'element');
        $filter = new Filter();
        $testee = new Standard($bem, $filter);

        echo $testee;

        self::expectOutputString('block__element');
    }

    public function testElement()
    {
        $bem = new Data('block', 'element');
        $filter = new Filter();
        $testee = new Standard($bem, $filter);

        $response = $testee->value();

        self::assertSame('block__element', $response);
    }

    public function testModifierOverrideElement()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $filter = new Filter();
        $testee = new Standard($bem, $filter);

        when('apply_filters')
            ->returnArg(2);

        $scope = $testee->value();

        $this->assertSame('block block--modifier', $scope);
    }

    public function testSanitizeHtmlClassKeepOnlyOneSpaceBetweenClasses()
    {
        when('apply_filters')
            ->alias(function () {
                return 'block  block--modifier  block--modifier-2';
            });
        when('sanitize_html_class')
            ->returnArg(1);

        $modifiers = new BlockModifiers(
            [
                'modifier',
                'modifier-2',
            ],
            'block'
        );
        $bem = new Data('block', 'element', $modifiers);
        $filter = new Filter();
        $testee = new Standard($bem, $filter);

        $response = $testee->value();

        $this->assertSame('block block--modifier block--modifier-2', $response);
    }
}
