<?php

declare(strict_types=1);

namespace Widoz\Bem\Tests;

use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

/**
 * Class Proxy
 *
 * Class extracted from ptrofimov/xpmock
 * @link https://github.com/ptrofimov/xpmock
 * @see https://github.com/ptrofimov/xpmock/blob/master/src/Xpmock/Reflection.php
 */
class Proxy
{
    private string $class;

    private object $object;

    public function __construct(string|object $classOrObject)
    {
        list($this->class, $this->object) = is_object($classOrObject)
            ? [get_class($classOrObject), $classOrObject]
            : [(string)$classOrObject, null];
    }

    /**
     * @param $key
     * @return mixed
     * @throws ReflectionException
     */
    public function __get(string $key)
    {
        $property = new ReflectionProperty($this->class, $key);
        if (!$property->isPublic()) {
            $property->setAccessible(true);
        }

        return $property->isStatic()
            ? $property->getValue()
            : $property->getValue($this->object);
    }

     /**
      * @throws ReflectionException
      */
    public function __set(string $key, mixed $value): self
    {
        $property = new ReflectionProperty($this->class, $key);
        if (!$property->isPublic()) {
            $property->setAccessible(true);
        }
        $property->isStatic()
            ? $property->setValue($value)
            : $property->setValue($this->object, $value);

        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function __call(string $methodName, array $args): mixed
    {
        $method = new ReflectionMethod($this->class, $methodName);

        if (!$method->isPublic()) {
            $method->setAccessible(true);
        }

        return $method->isStatic()
            ? $method->invokeArgs(null, $args)
            : $method->invokeArgs($this->object, $args);
    }
}
