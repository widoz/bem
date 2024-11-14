<?php

declare(strict_types=1);

namespace Widoz\Bem\Tests\Unit;

use Widoz\Bem\Bem;
use Widoz\Bem\Filter;
use Widoz\Bem\Standard;
use Widoz\Bem\Standard as Testee;
use Widoz\Bem\Tests\TestCase;

class StandardTest extends TestCase
{
    public function testInstance()
    {
        $bem = $this->createMock(Bem::class);
        $filter = $this->createMock(Filter::class);
        $testee = new Standard($bem, $filter);

        $this->assertInstanceOf(Standard::class, $testee);
    }

    public function testFilterIsApplied()
    {
        $bem = $this->createMock(Bem::class);
        $filter = $this->createMock(Filter::class);
        $testee = $this
            ->getMockBuilder(Testee::class)
            ->setConstructorArgs([$bem, $filter])
            ->setMethodsExcept(['value'])
            ->getMock();

        $filter
            ->expects($this->once())
            ->method('apply');

        $testee->value();

        self::assertTrue(true);
    }
}
