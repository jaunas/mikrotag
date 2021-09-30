#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Jaunas\Mikrotag\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Application;

Dotenv::createImmutable(__DIR__)->load();

$container = ContainerBuilder::create();

$application = $container->get(Application::class);
$application->run();
