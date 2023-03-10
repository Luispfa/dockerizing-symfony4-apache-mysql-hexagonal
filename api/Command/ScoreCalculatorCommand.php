<?php

declare(strict_types=1);

namespace Api\Command;

use App\Application\AdAllFinder;
use App\Application\ScoreCalculator;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScoreCalculatorCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:calculate-score';
    protected static $defaultDescription = 'Calcula score of Ads.';

    private $scoreCalculator;
    private $adAllFinder;

    public function __construct(ScoreCalculator $scoreCalculator, AdAllFinder $adAllFinder)
    {
        $this->scoreCalculator = $scoreCalculator;
        $this->adAllFinder = $adAllFinder;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to create a user...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$output instanceof ConsoleOutputInterface) {
            throw new \LogicException('This command accepts only an instance of "ConsoleOutputInterface".');
        }

        $this->scoreCalculator->__invoke();

        $getAll = $this->adAllFinder->__invoke()->ads();

        $table = new Table($output);
        $table->setHeaders(['id', 'typology',  'houseSize', 'gardenSize', 'score']);
        foreach ($getAll as ['id' => $id, 'typology' => $typology, 'houseSize' => $houseSize, 'gardenSize' => $gardenSize, 'score' => $score]) {
            $table->addRow([$id, $typology, $houseSize, $gardenSize, $score]);
        }
        $table->render();

        return 0;
    }
}
