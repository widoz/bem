<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Unit;

use Widoz\Bem\BlockModifiers;
use ProjectTestsHelper\Phpunit\TestCase;

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
}
