<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

abstract class PaginatedDataType implements DataType
{
    #[Field]
    public Pagination $pagination;
}
