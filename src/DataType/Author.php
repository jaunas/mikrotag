<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class Author implements DataType
{
    #[Field]
    public string $login;

    #[Field]
    public int $color;

    #[Field]
    public string $sex;

    #[Field]
    public string $avatar;
}
