<?php

namespace Jaunas\Mikrotag\Command;

use Jaunas\Mikrotag\DataType\EntryCollection;
use Jaunas\Mikrotag\Request\Hot;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FetchHot extends Command
{
    private Hot $hotRequest;

    public function __construct(Hot $hotRequest)
    {
        $this->hotRequest = $hotRequest;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('fetch-hot')
            ->addArgument('period', InputArgument::OPTIONAL)
            ->addOption('page', 'p', InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->configureRequest($input);

        $response = $this->hotRequest->getResponse();

        /** @var EntryCollection $entries */
        $entries = $response->getData();
        $output->writeln(print_r($entries, true));

        return 0;
    }

    private function configureRequest(InputInterface $input): void
    {
        $period = $input->getArgument('period');
        $page = $input->getOption('page');

        if ($period) {
            $this->hotRequest->setPeriod($period);
        }

        if ($page) {
            $this->hotRequest->setPage($page);
        }
    }
}
