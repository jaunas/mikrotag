<?php

namespace Jaunas\Mikrotag\DataType;

abstract class DataType
{
    public function __construct(
        protected array $dataArray
    ) {
        $this->parseResponse();
    }

    abstract protected function parseResponse(): void;
}
