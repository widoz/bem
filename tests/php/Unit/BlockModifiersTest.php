<?php

declare(strict_types=1);

namespace Widoz\Bem\Tests\Unit;

use Widoz\Bem\BlockModifiers;
use Widoz\Bem\Tests\TestCase;

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
