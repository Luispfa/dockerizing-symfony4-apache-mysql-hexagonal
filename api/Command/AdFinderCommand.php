<?php

declare(strict_types=1);

namespace Api\Command;

use App\Application\AdFinder;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AdFinderCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:get-ad';
    protected static $defaultDescription = 'Get One Ad.';

    private $adFinder;

    public function __construct(AdFinder $adFinder)
    {
        $this->adFinder = $adFinder;
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
        
        $calculate = $this->adFinder->__invoke($id)->ads();

        $table = new Table($output);
        $table->setHeaders(['id', 'typology',  'houseSize', 'gardenSize', 'score']);
        foreach ($calculate as ['id' => $id, 'typology' => $typology, 'houseSize' => $houseSize, 'gardenSize' => $gardenSize, 'score' => $score]) {
            $table->addRow([$id, $typology, $houseSize, $gardenSize, $score]);
        }
        $table->render();

        return 0;
    }
}
