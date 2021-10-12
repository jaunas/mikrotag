<?php

namespace Jaunas\Mikrotag;

use Jaunas\Mikrotag\DataType\DataType;
use ReflectionClass;
use ReflectionNamedType;

class Parser
{
    // TODO Consider making it array<string,CustomClass>
    /** @var array<string,array> */
    private array $map = [];

    /**
     * @param class-string $class
     */
    public function __construct(private string $class)
    {
        $this->buildMap();
    }

    /**
     * @param array<string,mixed> $data Raw data
     */
    public function parse(array $data): DataType
    {
        $object = new $this->class();

        foreach ($this->map as $fieldName => $property) {
            if (isset($data[$fieldName])) {
                $value = $data[$fieldName];

                /** @var ReflectionNamedType $type */
                $type = $property['type'];
                if ($type->getName() == 'array' && $property['itemType']) {
                    $value = $this->parseArray($data[$fieldName], $property['itemType']);
                } elseif (!$type->isBuiltIn() && class_exists($type->getName())) {
                    $value = $this->parseDataType($data[$fieldName], $type->getName());
                }

                $object->{$property['name']} = $value;
            }
        }

        return $object;
    }

    /**
     * @param array[] $array
     * @param class-string $itemType
     *
     * @return DataType[]
     */
    private function parseArray(array $array, string $itemType): array
    {
        $parser = new Parser($itemType);
        $value = [];
        foreach ($array as $item) {
            $value[] = $parser->parse($item);
        }

        return $value;
    }

    /**
     * @param array<string,mixed> $array
     * @param class-string $dataType
     */
    private function parseDataType(array $array, string $dataType): DataType
    {
        $parser = new Parser($dataType);
        return $parser->parse($array);
    }

    private function buildMap(): void
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
