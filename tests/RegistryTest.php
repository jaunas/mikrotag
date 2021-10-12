<?php

namespace Jaunas\Mikrotag\Tests;

use Dotenv\Dotenv;
use Jaunas\Mikrotag\Registry;
use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase
{
    /**
     * @dataProvider registryDataProvider
     */
    public function testRegistry(array $params, string $expectedApiKey, string $expectedSecretKey): void
    {
        $dotenv = $this
            ->getMockBuilder(Dotenv::class)
            ->disableOriginalConstructor()
            ->getMock();
        $dotenv
            ->method('load')
            ->willReturn($params);

        $registry = new Registry($dotenv);
        $this->assertEquals($expectedApiKey, $registry->getApiKey());
        $this->assertEquals($expectedSecretKey, $registry->getSecretKey());
    }

    public function registryDataProvider(): array
    {
        return [
            [
                'params' => [
                    'API_KEY' => 'test_api_key',
                    'SECRET_KEY' => 'test_secret_key'
                ],
                'expectedApiKey' => 'test_api_key',
                'expectedSecretKey' => 'test_secret_key'
            ],
            [
                'params' => [
                    'API_KEY' => '',
                    'SECRET_KEY' => ''
                ],
                'expectedApiKey' => '',
                'expectedSecretKey' => ''
            ],
            [
                'params' => [],
                'expectedApiKey' => '',
                'expectedSecretKey' => ''
            ]
        ];
    }
}
