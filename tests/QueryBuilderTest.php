<?php

namespace Jaunas\Mikrotag\Tests;

use Jaunas\Mikrotag\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{
    public function testEmptyQuery(): void
    {
        $queryBuilder = new QueryBuilder();
        $this->assertEmpty($queryBuilder->getQuery());
    }

    public function testAddPart(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addPart('part_one');
        $this->assertEquals('part_one', $queryBuilder->getQuery());

        $queryBuilder->addPart('part_two');
        $this->assertEquals('part_one/part_two', $queryBuilder->getQuery());

        $queryBuilder->addPart('part_three');
        $this->assertEquals('part_one/part_two/part_three', $queryBuilder->getQuery());
    }

    public function testAddParts(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addParts(['part_one', 'part_two', 'part_three']);
        $this->assertEquals('part_one/part_two/part_three', $queryBuilder->getQuery());

        $queryBuilder->addParts(['second_part_one', 'second_part_two']);
        $this->assertEquals(
            'part_one/part_two/part_three/second_part_one/second_part_two',
            $queryBuilder->getQuery()
        );
    }

    public function testAddPartsWithKeys(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addPartsWithKeys([
            'key1' => 'part1',
            'key2' => 'part2',
            'key3' => 'part3'
        ]);
        $this->assertEquals('key1/part1/key2/part2/key3/part3', $queryBuilder->getQuery());

        $queryBuilder->addPartsWithKeys([
            'second_key1' => 'second_part1',
            'second_key2' => 'second_part2'
        ]);
        $this->assertEquals(
            'key1/part1/key2/part2/key3/part3/second_key1/second_part1/second_key2/second_part2',
            $queryBuilder->getQuery()
        );
    }

    public function testCombinedMethods(): void
    {
        $queryBuilder = new QueryBuilder();

        $queryBuilder->addPart('part_one');
        $queryBuilder->addParts(['part_two', 'part_three']);
        $queryBuilder->addPartsWithKeys([
            'key4' => 'part4',
            'key5' => 'part5'
        ]);

        $this->assertEquals('part_one/part_two/part_three/key4/part4/key5/part5', $queryBuilder->getQuery());
    }
}
