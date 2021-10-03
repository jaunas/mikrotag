<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class Pagination implements DataType
{
    #[Field]
    public string $next;
}
