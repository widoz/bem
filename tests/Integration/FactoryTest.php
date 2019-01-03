<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Widoz\Bem\Factory;
use Widoz\Bem\Service;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;

class FactoryTest extends TestCase
{
    public function testCreateStandard()
    {
        $testee = Factory::createStandard('block');

        self::assertInstanceOf(Standard::class, $testee);
    }

    public function testCreateServiceForStandard()
    {
        $testee = Factory::createServiceForStandard('block');

        self::assertInstanceOf(Service::class, $testee);
    }
}
