#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Jaunas\Mikrotag\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Application;

$container = ContainerBuilder::create();

$application = $container->get(Application::class);
$application->run();
