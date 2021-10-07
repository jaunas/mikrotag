<?php

namespace Jaunas\Mikrotag;

class QueryBuilder
{
    /** @var string[] */
    private array $parts = [];

    public function addPart(string $part): self
    {
        $this->parts[] = $part;

        return $this;
    }

    /**
     * @param array<string,string> $parts
     */
    public function addPartsWithKeys(array $parts): self
    {
        foreach ($parts as $key => $value) {
            $this->parts[] = $key;
            $this->parts[] = $value;
        }

        return $this;
    }

    /**
     * @param string[] $parts
     */
    public function addParts(array $parts): self
    {
        $this->parts = array_merge($this->parts, $parts);

        return $this;
    }

    public function getQuery(): string
    {
        return implode('/', $this->parts);
    }
}
