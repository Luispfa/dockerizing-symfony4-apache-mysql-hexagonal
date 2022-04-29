<?php

declare(strict_types=1);

namespace Api\Command;

use App\Application\Bus\Query\AdFinderQuery;
use App\Domain\Bus\Query\QueryHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdFinderCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:get-ad';
    protected static $defaultDescription = 'Get One Ad.';

    private $queryHandler;

    public function __construct(QueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'The Id of the Ad.')
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $id = (int)$input->getArgument('id');
        $query = $this->queryHandler;
        $response = $query(new AdFinderQuery($id));

        $json = new JsonResponse($response->ads());

        $section1 = $output->section();
        $section1->writeln($json);

        return 0;
    }
}
