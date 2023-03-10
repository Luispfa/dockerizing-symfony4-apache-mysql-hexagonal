<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Command\ScoreCalculatorCommandHandler;

final class ScoreCalculator
{
    private $commandHandler;

    public function __construct(ScoreCalculatorCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    public function __invoke(): void
    {
        $this->commandHandler->__invoke();
    }
}
