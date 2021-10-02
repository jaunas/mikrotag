<?php

namespace Jaunas\Mikrotag;

use Attribute;

#[Attribute]
class Field
{
    public function __construct(
        private ?string $name = null,
        private ?string $itemType = null
    ) {}

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getItemType(): ?string
    {
        return $this->itemType;
    }
}
