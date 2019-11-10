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

use Widoz\Bem\Bem;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\Standard;
use Widoz\Hooks\Dispatch\RemoveCapableHookDispatcher;

class StandardTest extends TestCase
{
    public function testFilterIsApplied()
    {
        $bem = $this->createMock(Bem::class);
        $removeCapableHookDispatcher = $this->createMock(RemoveCapableHookDispatcher::class);

        $standard = $this
            ->getMockBuilder(Standard::class)
            ->setConstructorArgs([$bem, $removeCapableHookDispatcher])
            ->setMethodsExcept(['value'])
            ->getMock();

        $removeCapableHookDispatcher->expects($this->once())->method('__invoke');

        $standard->value();
    }
}
