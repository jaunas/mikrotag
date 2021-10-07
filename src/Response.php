<?php

namespace Jaunas\Mikrotag;

use Exception;
use Jaunas\Mikrotag\DataType\DataType;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Response
{
    /** @var array<mixed,mixed> Raw response in array format */
    private array $response;

    private DataType $data;

    public function __construct(
        private ResponseInterface $httpResponse,
        private string $dataType
    ) {
        $this->validate();
        $this->response = json_decode($this->httpResponse->getContent(), true);
        $parser = new Parser($this->dataType);
        $this->data = $parser->parse($this->response);
    }

    /**
     * @return array<mixed,mixed>
     */
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
            throw new Exception('Response is not valid');
        }
        // TODO
    }
}
