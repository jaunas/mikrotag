<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class EntryCollection extends PaginatedDataType
{
    /** @var Entry[] */
    #[Field('data', Entry::class)]
    public array $entries;

}
