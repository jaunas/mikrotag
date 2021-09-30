<?php

namespace Jaunas\Mikrotag\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContainerBuilder
{
    public static function create(): SymfonyContainerBuilder
    {
        $builder = new SymfonyContainerBuilder();
        $loader = new YamlFileLoader($builder, new FileLocator(__DIR__ . '/../..'));
        $loader->load('services.yaml');
        $builder->compile();

        return $builder;
    }
}
