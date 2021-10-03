<?php

namespace Jaunas\Mikrotag;

use Jaunas\Mikrotag\DataType\DataType;
use ReflectionClass;
use ReflectionNamedType;

class Parser
{
    private array $map = [];

    public function __construct(private string $class)
    {
        $this->buildMap();
    }

    public function parse(array $data): DataType
    {
        $object = new ($this->class)();

        foreach ($this->map as $fieldName => $property) if (isset($data[$fieldName])) {
            $value = $data[$fieldName];

            /** @var ReflectionNamedType $type */
            $type = $property['type'];
            if ($type->getName() == 'array' && $property['itemType']) {
                $value = $this->parseArray($data[$fieldName], $property['itemType']);
            } elseif (!$type->isBuiltIn()) {
                $value = $this->parseDataType($data[$fieldName], $type->getName());
            }

            $object->{$property['name']} = $value;
        }

        return $object;
    }

    private function parseArray(array $array, string $itemType): array
    {
        $parser = new Parser($itemType);
        $value = [];
        foreach ($array as $item) {
            $value[] = $parser->parse($item);
        }

        return $value;
    }

    private function parseDataType(array $array, string $dataType): DataType
    {
        $parser = new Parser($dataType);
        return $parser->parse($array);
    }

    private function buildMap()
    {
        $reflectionClass = new ReflectionClass($this->class);

        foreach ($reflectionClass->getProperties() as $property) {
            $attributes = $property->getAttributes(Field::class);

            foreach ($attributes as $attribute) {
                /** @var Field $field */
                $field = $attribute->newInstance();
                $fieldName = $field->getName() ?: $property->name;
                $this->map[$fieldName] = [
                    'name' => $property->name,
                    'type' => $property->getType(),
                    'itemType' => $field->getItemType()
                ];
            }
        }
    }
}
