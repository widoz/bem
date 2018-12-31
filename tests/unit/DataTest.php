<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\unit;

use Widoz\Bem\Data;
use PHPUnit\Framework\TestCase;
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
