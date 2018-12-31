<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Widoz\Bem\Factory;
use Widoz\Bem\Namespaced;
use Widoz\Bem\Standard;
use Widoz\Bem\Tests\TestCase;

class FactoryTest extends TestCase
{
    public function testCreateStandard()
    {
        $testee = Factory::createStandard('block');

        self::assertInstanceOf(Standard::class, $testee);
    }

    public function testCreateWithNamespace()
    {
        $testee = Factory::createWithNamespace('namespace', 'block');

        self::assertInstanceOf(Namespaced::class, $testee);
    }
}
