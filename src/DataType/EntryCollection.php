<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class EntryCollection implements DataType
{
    /** @var Entry[] */
    #[Field('data', Entry::class)]
    public array $entries;

    public function getEntries(): array
    {
        return $this->entries;
    }
}
