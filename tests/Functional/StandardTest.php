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

namespace Widoz\Bem\Tests\Functional;

use Widoz\Bem\Bem;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

class StandardTest extends TestCase
{
    public function testInstance()
    {
        /** @var Bem $bem */
        $bem = $this->createMock(Bem::class);
        /** @var RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $standard = new Standard($bem, $removeCapableHookDispatcher);

        $this->assertInstanceOf(Standard::class, $standard);
    }

    public function testFilterIsApplied()
    {
        /** @var Bem $bem */
        $bem = $this->createMock(Bem::class);
        /** @var RemoveCapableHookDispatcher $removeCapableHookDispatcher */
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);
        $standard = new Standard($bem, $removeCapableHookDispatcher);

        $removeCapableHookDispatcher->expects($this->once())->method('__invoke');

        $standard->value();

        self::assertTrue(true);
    }
}
