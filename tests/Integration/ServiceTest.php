<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Widoz\Bem\Data;
use Widoz\Bem\Filter;
use Widoz\Bem\Standard;
use ProjectTestsHelper\Phpunit\TestCase;
use Widoz\Bem\Service;
use Widoz\Bem\Valuable;

class ServiceTest extends TestCase
{
    public function testInstance()
    {
        $bem = new Data('block');
        $filter = new Filter();
        $value = new Standard($bem, $filter);
        $testee = new Service($bem, $value, $filter);

        self::assertInstanceOf(Service::class, $testee);
    }

    public function testValue()
    {
        $bem = new Data('block');
        $filter = new Filter();
        $value = new Standard($bem, $filter);
        $testee = new Service($bem, $value, $filter);

        self::assertInstanceOf(Valuable::class, $testee->value());
    }

    public function testServiceValueElement()
    {
        $bem = new Data('block');
        $filter = new Filter();
        $value = new Standard($bem, $filter);
        $testee = new Service($bem, $value, $filter);

        $response = $testee
            ->forElement('element')
            ->value();

        self::assertSame('block__element', $response);
    }

    public function testServiceValueModifiers()
    {
        $bem = new Data('block');
        $filter = new Filter();
        $value = new Standard($bem, $filter);
        $testee = new Service($bem, $value, $filter);

        $response = $testee
            ->withModifiers(['modifier'])
            ->value();

        self::assertSame('block block--modifier', $response);
    }
}
