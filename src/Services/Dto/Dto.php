<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services\Dto;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class Dto
 * @package Nighthtr\Jira\Services\Dto
 */
class Dto
{
    /**
     * @param array $data
     * @return static
     * @throws ReflectionException
     */
    public static function create(array $data): static
    {
        return self::prepareValuesRecursive($data);
    }

    /**
     * @param array $data
     * @return static
     * @throws ReflectionException
     */
    public function load(array $data): static
    {
        return self::prepareValuesRecursive($data);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ReflectionException
     */
    public static function prepareValuesRecursive(array $data): mixed
    {
        $class = new ReflectionClass(static::class);
        $object = $class->newInstance();

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $propertyName = $property->getName();
            $propertyClassName = $property->getType()->getName();

            if (array_key_exists($propertyName, $data)) {
                if (is_array($data[$propertyName]) && $propertyClassName != null && class_exists($propertyClassName)) {
                    $object->$propertyName = $propertyClassName::create($data[$propertyName]);
                } else {
                    $object->$propertyName = $data[$propertyName];
                }
            }
        }

        return $object;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = (array) $this;

        foreach ($data as $key => $value) {
            if ($value instanceof Dto) {
                $data[$key] = $value->toArray();
            }
        }

        return $data;
    }
}