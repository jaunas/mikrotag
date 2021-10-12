<?php

namespace Jaunas\Mikrotag\Request;

use Jaunas\Mikrotag\QueryBuilder;
use Jaunas\Mikrotag\Registry;
use Jaunas\Mikrotag\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class Request
{
    private const BASE_URL = 'https://a2.wykop.pl';

    public function __construct(private HttpClientInterface $client, private Registry $registry)
    {
    }

    public function getResponse(): Response
    {
        $url = $this->getUrl();
        $signature = md5($this->registry->getSecretKey() . $url);
        $httpResponse = $this->client->request('GET', $url, ['headers' => ['apisign' => $signature]]);

        return new Response($httpResponse, $this->getDataType());
    }

    public function getUrl(): string
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->addParts([self::BASE_URL, $this->getEndpoint()])
            ->addPartsWithKeys($this->getParameters())
            ->addPartsWithKeys(['appkey' => $this->registry->getApiKey()])
            ->getQuery();
    }

    abstract protected function getEndpoint(): string;

    /**
     * @return array<string,mixed>
     */
    abstract protected function getParameters(): array;

    /**
     * @return class-string
     */
    abstract protected function getDataType(): string;
}
