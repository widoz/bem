<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Brain\Monkey\Filters;
use Widoz\Bem\Data;
use Widoz\Bem\Namespaced;
use Widoz\Bem\Standard;
use Widoz\Bem\Tests\TestCase;

class NamespacedTest extends TestCase
{
    public function testTheFilterUsedIsTheNamespacedOne()
    {
        $bem = new Data('block');
        $value = new Standard($bem);
        $testee = new Namespaced($value, 'namespace');

        Filters\expectApplied(Namespaced::FILTER_VALUE)
            ->once();

        $testee->value();

        self::assertTrue(true);
    }
}
