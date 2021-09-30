<?php

namespace Jaunas\Mikrotag\DataType;

class EntryCollection extends DataType
{
    private array $entries = [];

    protected function parseResponse(): void
    {
        foreach ($this->dataArray as $item) {
            $this->entries[] = new Entry($item);
        }
    }

    public function getEntries(): array
    {
        return $this->entries;
    }
}
