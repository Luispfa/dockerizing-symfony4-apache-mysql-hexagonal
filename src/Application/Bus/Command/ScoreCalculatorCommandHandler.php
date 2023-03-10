<?php

declare(strict_types=1);

namespace App\Application\Bus\Command;

use App\Domain\ScoreAd;

final class ScoreCalculatorCommandHandler
{
    private $scoreAd;

    public function __construct(ScoreAd $scoreAd)
    {
        $this->scoreAd = $scoreAd;
    }

    public function __invoke(): void
    {
        $this->scoreAd->__invoke();
    }
}