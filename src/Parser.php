<?php

namespace Jaunas\Mikrotag;

use Jaunas\Mikrotag\DataType\DataType;
use ReflectionClass;

class Parser
{
    private array $map = [];

    public function __construct(private string $class)
    {
        $this->buildMap();
    }

    public function parse(array $data): DataType
    {
        $object = new ($this->class)([]);

        foreach ($this->map as $fieldName => $property) if (isset($data[$fieldName])) {
            $value = $data[$fieldName];
            if ($property['type']->getName() == 'array' && $property['itemType']) {
                $value = $this->parseArray($data[$fieldName], $property['itemType']);
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
