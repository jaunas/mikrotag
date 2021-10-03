<?php

namespace Jaunas\Mikrotag\Request;

use Jaunas\Mikrotag\QueryBuilder;
use Jaunas\Mikrotag\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class Request
{
    private const BASE_URL = 'https://a2.wykop.pl';

    private HttpClientInterface $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function getResponse(): Response
    {
        $url = $this->getUrl();
        $signature = md5($_ENV['SECRET_KEY'] . $url);
        $httpResponse = $this->client->request('GET', $url, ['headers' => ['apisign' => $signature]]);

        return new Response($httpResponse, $this->getDataType());
    }

    public function getUrl(): string
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->addParts([self::BASE_URL, $this->getEndpoint()])
            ->addPartsWithKeys($this->getParameters())
            ->addPartsWithKeys(['appkey' => $_ENV['API_KEY']])
            ->getQuery();
    }

    abstract protected function getEndpoint(): string;
    abstract protected function getParameters(): array;
    abstract protected function getDataType(): string;
}
