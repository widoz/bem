<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Widoz\Bem\Tests\Integration;

use Widoz\Bem\BlockModifiers;
use Widoz\Bem\Data;
use Widoz\Bem\Standard;
use Widoz\Bem\Tests\TestCase;
use Widoz\Bem\Service;

class ServiceTest extends TestCase
{
    public function testInstance()
    {
        $bem = new Data('block');
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        self::assertInstanceOf(Service::class, $testee);
    }

    public function testServiceValueBlock()
    {
        $bem = new Data('block');
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $response = $testee->value();

        self::assertSame('block', $response);
    }

    public function testServiceValueElement()
    {
        $bem = new Data('block', 'element');
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $response = $testee->value();

        self::assertSame('block__element', $response);
    }

    public function testServiceValueModifiers()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $response = $testee->value();

        self::assertSame('block block--modifier', $response);
    }

    public function testForBlock()
    {
        $bem = new Data('block');
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $testee->forBlock('newBlock');

        $response = $testee->value();

        self::assertSame('newBlock', $response);
    }

    public function testForElement()
    {
        $bem = new Data('block', 'element');
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $testee->forElement('newElement');

        $response = $testee->value();

        self::assertSame('block__newElement', $response);
    }

    public function testWithModifiers()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $testee->withModifiers(['newModifier']);

        $response = $testee->value();

        self::assertSame('block block--newModifier', $response);
    }

    public function testModifiersWorksAsExpectedIfBlockChange()
    {
        $modifiers = new BlockModifiers(['modifier'], 'block');
        $bem = new Data('block', 'element', $modifiers);
        $value = new Standard($bem);
        $testee = new Service($bem, $value);

        $testee->forBlock('newBlock');

        $response = $testee->value();

        self::assertSame('newBlock newBlock--modifier', $response);
    }
}
