<?php

namespace Jaunas\Mikrotag;

use Jaunas\Mikrotag\DataType\DataType;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Response
{
    private array $response;

    private DataType $data;

    public function __construct(
        private ResponseInterface $httpResponse,
        private string $dataType
    )
    {
        $this->validate();
        $this->response = json_decode($this->httpResponse->getContent(), true);
        $parser = new Parser($this->dataType);
        $this->data = $parser->parse($this->response);
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getData(): DataType
    {
        return $this->data;
    }

    private function validate(): void
    {
        if ($this->httpResponse->getStatusCode() != 200) {
            throw new \Exception('Response is not valid');
        }
        // TODO
    }
}
