<?php

declare(strict_types=1);

namespace App\Domain\Score;

final class ScoreDescription extends ScoreAbstract
{
    const DEFAULT_SCORE = 5;

    public function __invoke(): int
    {
        return strlen($this->ad->getDescription()) > 0 ? self::DEFAULT_SCORE : 0;
    }
}
