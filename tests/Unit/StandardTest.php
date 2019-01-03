<?php # -*- coding: utf-8 -*-

/*
 * This file is part of the bem package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Widoz\Bem\Tests\Unit;

use Brain\Monkey\Filters;
use Widoz\Bem\Bem;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;

class StandardTest extends TestCase
{
    public function testInstance()
    {
        $bem = $this->createMock(Bem::class);
        $testee = new Standard($bem);

        $this->assertInstanceOf(Standard::class, $testee);
    }

    public function testFilterIsApplied()
    {
        $bem = $this->createMock(Bem::class);
        $testee = new Standard($bem);

        Filters\expectApplied(Standard::FILTER_VALUE)
            ->once();

        $testee->value();

        self::assertTrue(true);
    }
}
