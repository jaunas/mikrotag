<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class EntryCollection extends DataType
{
    /** @var Entry[] */
    #[Field('data', Entry::class)]
    public array $entries;

    public function getEntries(): array
    {
        return $this->entries;
    }
}
