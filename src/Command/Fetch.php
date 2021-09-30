<?php

namespace Jaunas\Mikrotag\Command;

use Jaunas\Mikrotag\DataType\EntryCollection;
use Jaunas\Mikrotag\Request\Hot;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Fetch extends Command
{
    protected function configure(): void
    {
        $this->setName('fetch');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $request = new Hot();
        $output->writeln($request->getUrl());
        $response = $request->request();
        /** @var EntryCollection $entries */
        $entries = $response->getData();
        $output->writeln(print_r($entries->getEntries(), true));

        return 0;
    }
}
