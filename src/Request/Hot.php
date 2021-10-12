<?php

namespace Jaunas\Mikrotag\Request;

use Jaunas\Mikrotag\DataType\EntryCollection;

class Hot extends Request
{
    private int $page = 1;
    private int $period = 6;

    protected function getEndpoint(): string
    {
        return 'entries/hot';
    }

    /**
     * @return array{page: int, period: int}
     */
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

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): Hot
    {
        $this->page = $page;
        return $this;
    }

    public function getPeriod(): int
    {
        return $this->period;
    }

    public function setPeriod(int $period): Hot
    {
        $this->period = $period;
        return $this;
    }
}
