<?php

namespace Jaunas\Mikrotag\DataType;

use Jaunas\Mikrotag\Field;

class Embed implements DataType
{
    #[Field]
    public string $type;

    #[Field]
    public string $url;

    #[Field]
    public string $source;

    #[Field]
    public string $preview;

    #[Field]
    public ?string $plus18;

    #[Field]
    public string $size;

    #[Field]
    public ?string $animated;

    #[Field]
    public float $ratio;
}
