<?php
/**
 * ClassAttributeTest
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Widoz\Tests
 * @copyright Copyright (c) 2017, Guido Scialfa
 * @license   GNU General Public License, version 2
 *
 * Copyright (C) 2017 Guido Scialfa <dev@guidoscialfa.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Widoz\Tests\Unit;

use Brain\Monkey\Filters;
use Widoz\Bem\Namespaced;
use Widoz\Bem\Standard;
use Widoz\Bem\Tests\TestCase;
use Widoz\Bem\Value;

class NamespacedTest extends TestCase
{
    public function testInstance()
    {
        $bem = $this->createMock(Standard::class);
        $testee = new Namespaced($bem, 'prefix');

        $this->assertInstanceOf(Namespaced::class, $testee);
    }

    public function testPrefixIsAddedToBemString()
    {
        $bem = $this->createMock(Standard::class);
        $testee = new Namespaced($bem, 'prefix');

        $bem
            ->expects($this->once())
            ->method('value')
            ->willReturn('block__element');

        $scope = $testee->value();

        $this->assertSame('prefixblock__element', $scope);
    }

    public function testToString()
    {
        $bem = $this->createMock(Standard::class);
        $testee = new Namespaced($bem, 'prefix');

        $bem
            ->expects($this->once())
            ->method('value')
            ->willReturn('block__element');

        echo $testee;

        $this->expectOutputString('prefixblock__element');
    }

    public function testFilterIsApplied()
    {
        $value = $this->createMock(Value::class);
        $testee = new Namespaced($value, 'namespace');

        Filters\expectApplied(Namespaced::FILTER_VALUE)
            ->once();

        $testee->value();

        self::assertTrue(true);
    }
}
