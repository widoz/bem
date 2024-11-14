<?php

declare(strict_types=1);

namespace Widoz\Bem\Tests\Integration;

use Widoz\Bem\StandardFactory as Testee;
use Widoz\Bem\Service;
use Widoz\Bem\Tests\TestCase;
use Widoz\Bem\Valuable;

class StandardFactoryTest extends TestCase
{
    public function testInstance()
    {
        $testee = new Testee();

        self::assertInstanceOf(Testee::class, $testee);
    }

    public function testCreateStandard()
    {
        $testee = new Testee();

        self::assertInstanceOf(Valuable::class, $testee->create('block'));
    }

    public function testCreateServiceForStandard()
    {
        $testee = new Testee();

        self::assertInstanceOf(Service::class, $testee->createService('block'));
    }
}
