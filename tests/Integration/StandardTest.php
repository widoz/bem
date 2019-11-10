<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use PHPUnit\Framework\MockObject\MockObject;
use Widoz\Bem\Data;
use Widoz\Bem\BlockModifiers;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;
use function Brain\Monkey\Functions\when;

class StandardTest extends TestCase
{
    public function testToString()
    {
        $bem = new Data('block', 'element');
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $testee = new Standard($bem, $removeCapableHookDispatcher);

        // Expect to return a valid value from filter
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        echo $testee;

        self::expectOutputString('block__element');
    }

    public function testElement()
    {
        $bem = new Data('block', 'element');
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $testee = new Standard($bem, $removeCapableHookDispatcher);

        // Expect to return a valid value from filter
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        $response = $testee->value();

        self::assertSame('block__element', $response);
    }

    public function testModifierOverrideElement()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $testee = new Standard($bem, $removeCapableHookDispatcher);

        // Expect to return a valid value from filter
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        $scope = $testee->value();

        $this->assertSame('block block--modifier', $scope);
    }

    public function testSanitizeHtmlClassKeepOnlyOneSpaceBetweenClasses()
    {
        when('apply_filters')->alias(function () {
                return 'block  block--modifier  block--modifier-2';
            });
        when('sanitize_html_class')->returnArg(1);

        $modifiers = new BlockModifiers(
            [
                'modifier',
                'modifier-2',
            ],
            'block'
        );
        $bem = new Data('block', 'element', $modifiers);
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $testee = new Standard($bem, $removeCapableHookDispatcher);

        // Expect to return a valid value from filter
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        $response = $testee->value();

        $this->assertSame('block block--modifier block--modifier-2', $response);
    }
}
