<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use PHPUnit\Framework\MockObject\MockObject;
use Widoz\Bem\Data;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\Service;
use Widoz\Bem\Valuable;
use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

class ServiceTest extends TestCase
{
    public function testInstance()
    {
        $bem = new Data('block');
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $value = new Standard($bem, $removeCapableHookDispatcher);
        $testee = new Service($bem, $value, $removeCapableHookDispatcher);

        self::assertInstanceOf(Service::class, $testee);
    }

    public function testValue()
    {
        $bem = new Data('block');
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $value = new Standard($bem, $removeCapableHookDispatcher);
        $testee = new Service($bem, $value, $removeCapableHookDispatcher);

        self::assertInstanceOf(Valuable::class, $testee->value());
    }

    public function testServiceValueElement()
    {
        $bem = new Data('block');
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $value = new Standard($bem, $removeCapableHookDispatcher);
        $testee = new Service($bem, $value, $removeCapableHookDispatcher);

        /*
         * Expect to return a valid filtered value
         */
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        $response = $testee->forElement('element')->value();

        self::assertSame('block__element', $response);
    }

    public function testServiceValueModifiers()
    {
        $bem = new Data('block');
        /** @var RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $value = new Standard($bem, $removeCapableHookDispatcher);
        $testee = new Service($bem, $value, $removeCapableHookDispatcher);

        /*
         * Expect to return a valid filtered value
         */
        $removeCapableHookDispatcher->method('__invoke')->willReturnArgument(1);

        $response = $testee->withModifiers(['modifier'])->value();

        self::assertSame('block block--modifier', $response);
    }
}
