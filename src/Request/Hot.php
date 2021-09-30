<?php

namespace Jaunas\Mikrotag\Request;

use Jaunas\Mikrotag\DataType\EntryCollection;

class Hot extends Request
{
    public function __construct(private int $page = 1, private int $period = 6)
    {
        parent::__construct();
    }

    protected function getEndpoint(): string
    {
        return 'entries/hot';
    }

    protected function getParameters(): array
    {
        return [
            'page' => $this->page,
            'period' => $this->period
        ];
    }

    protected function getDataType(): string
    {
        return EntryCollection::class;
    }
}
