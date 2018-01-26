<?php
/**
 * ClassAttributeTest
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Unprefix\Tests
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

namespace Unprefix\Tests\Unit;

use Unprefix\Bem\BemPrefixed;
use Unprefix\Tests\UnprefixTestCase;

class BemPrefixedTest extends UnprefixTestCase
{
    public function testInstance()
    {
        $sut = new BemPrefixed('block');

        $this->assertInstanceOf('\\Unprefix\\Bem\\BemPrefixed', $sut);
    }

    public function testReturnedTypeIsString()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut = new BemPrefixed('block', 'element', []);

        $scope = $sut->scope();

        $this->assertInternalType('string', $scope);
    }

    public function testScopePassingBlock()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut   = new BemPrefixed('block', 'element', []);
        $scope = $sut->scope();

        $this->assertSame('block__element', $scope);
    }

    public function testScopePassingModifier()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut   = new BemPrefixed('block', 'element', ['modifier']);
        $scope = $sut->scope();

        $this->assertSame('block block--modifier', $scope);
    }

    public function testElementContains2Underscores()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut = new BemPrefixed('block', 'element', []);

        $scope = $sut->scope();

        $this->assertContains('__', $scope);
    }

    public function testModifierContains2Dashes()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut = new BemPrefixed('block', '', ['modifier']);

        $scope = $sut->scope();

        $this->assertContains('--', $scope);
    }

    public function testModifierOverrideElement()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut = new BemPrefixed('block', 'element', ['modifier']);

        $scope = $sut->scope();

        $this->assertNotContains('element', $scope);
    }

    public function testScopePassingMultipleModifier()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut   = new BemPrefixed(
            'block',
            'element',
            array('modifier', 'another-modifier', 'third-modifier')
        );
        $scope = $sut->scope();

        $this->assertSame(
            'block block--modifier block--another-modifier block--third-modifier',
            $scope
        );
    }

    /**
     * @dataProvider modifierProvider
     */
    public function testModifierGetSanitized(string $actual, string $expected)
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut   = new BemPrefixed('block', 'element', [$actual]);
        $scope = $sut->scope();

        $this->assertSame('block block--' . $expected, $scope);
    }

    public function modifierProvider(): array
    {
        return [
            [
                'name with spaces',
                'name-with-spaces',
            ],
            [
                'name_with_underscores',
                'name-with-underscores',
            ],
        ];
    }

    public function testSanitizeHtmlClassKeepSpaces()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        $sut = new BemPrefixed('block', '', ['modifier', 'modifier2']);

        $scope = $sut->scope();

        $this->assertSame('block block--modifier block--modifier2', $scope);
    }

    public function testSanitizeHtmlClassKeepOnlyOneSpaceBetweenClasses()
    {
        \Brain\Monkey\Functions\when('apply_filters')
            ->returnArg(2);
        \Brain\Monkey\Functions\when('sanitize_html_class')
            ->returnArg(1);

        // 2 spaces.
        add_filter('unprefix_scope_attribute', function ($upxscope) {
            return 'block  block--modifier  block--modifier2';
        });

        $sut = new BemPrefixed('block', '', array('modifier', 'modifier2'), '');

        $scope = $sut->scope();

        $this->assertSame('block block--modifier block--modifier2', $scope);
    }
}
