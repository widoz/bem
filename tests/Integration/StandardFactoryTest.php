<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use PHPUnit\Framework\MockObject\MockObject;
use Widoz\Bem\StandardFactory;
use Widoz\Bem\Service;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\Valuable;
use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

class StandardFactoryTest extends TestCase
{
    public function testCreateStandard()
    {
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $standardFactory = new StandardFactory($removeCapableHookDispatcher);

        self::assertInstanceOf(Valuable::class, $standardFactory->create('block'));
    }

    public function testCreateServiceForStandard()
    {
        /** @var MockObject|RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $standardFactory = new StandardFactory($removeCapableHookDispatcher);

        self::assertInstanceOf(Service::class, $standardFactory->createService('block'));
    }
}
