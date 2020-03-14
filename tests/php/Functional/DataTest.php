<?php

namespace Widoz\Bem\Tests\Functional;

use Widoz\Bem\Data;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\Modifiers;
use Widoz\Bem\NullModifiers;

class DataTest extends TestCase
{
    public function testsInstance()
    {
        $modifiers = $this->createMock(Modifiers::class);
        $data = new Data('block', 'element', $modifiers);

        self::assertInstanceOf(Data::class, $data);
    }

    public function testData()
    {
        $modifiers = $this->createMock(Modifiers::class);
        $data = new Data('block', 'element', $modifiers);

        self::assertSame('block', $data->block());
        self::assertSame('element', $data->element());
        self::assertSame($modifiers, $data->modifiers());
    }

    public function testDataModifiersAreNullModifiersIfNotExplicitlySet()
    {
        $data = new Data('block');

        $modifiers = $data->modifiers();
        self::assertInstanceOf(NullModifiers::class, $modifiers);
    }
}
