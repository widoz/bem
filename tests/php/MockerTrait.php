<?php

declare(strict_types=1);

namespace Widoz\Bem\Tests;

use PHPUnit\Framework\MockObject\MockBuilder;
use ProjectTestsHelper\Proxy;

/**
 * Trait MockerTrait
 *
 * @author Guido Scialfa <dev@guidoscialfa.com>
 */
trait MockerTrait
{
    /**
     * Build the Sut Mock Object
     *
     * Basic configuration available for all of the sut objects, call `getMock` to get the mock.
     *
     * @param string $className
     * @param array $constructorArguments
     * @param array $methods
     * @return MockBuilder
     */
    protected function mockBuilder(
        string $className,
        array $constructorArguments,
        array $methods
    ): MockBuilder {

        /** @var MockBuilder $sut */
        $sut = $this->getMockBuilder($className);

        $constructorArguments
            ? $sut->setConstructorArgs($constructorArguments)
            : $sut->disableOriginalConstructor();

        $sut->setMethods($methods ?: null);

        return $sut;
    }

    /**
     * Retrieve Proxy instance from a mock
     *
     * return MockBuilder
     * @param string $className
     * @param array $constructorArguments
     * @param array $methods
     * @return Proxy
     */
    protected function proxy(string $className, array $constructorArguments, array $methods): Proxy
    {
        $sut = $this->mockBuilder($className, $constructorArguments, $methods)->getMock();

        return new Proxy($sut);
    }
}
