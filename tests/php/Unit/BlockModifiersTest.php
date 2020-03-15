<?php

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

    public function testToString()
    {
        $testee = new BlockModifiers(['modifier', 'modifier-2'], 'block');

        self::assertSame('block--modifier block--modifier-2', (string)$testee);
    }
}
