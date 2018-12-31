<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\unit;

use Widoz\Bem\BlockModifiers;
use PHPUnit\Framework\TestCase;

class BlockModifiersTest extends TestCase
{
    public function testInstance()
    {
        $testee = new BlockModifiers(['modifier'], 'block');

        self::assertInstanceOf(BlockModifiers::class, $testee);
    }

    public function testStringify()
    {
        $testee = new BlockModifiers(['modifier', 'modifier-2'], 'block');

        $response = $testee->stringify();

        self::assertSame('block--modifier block--modifier-2', $response);
    }

    /**
     * @dataProvider typeProvider
     */
    public function testStringifyThrownExceptionIfModifiersAreNotStrings($data)
    {
        $this->expectException(\RuntimeException::class);

        new BlockModifiers([$data], 'block');
    }

    public function typeProvider()
    {
        return [
            [1],
            [[]],
            [null],
            [false]
        ];
    }
}
