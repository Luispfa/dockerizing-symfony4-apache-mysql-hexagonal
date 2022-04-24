<?php

declare(strict_types=1);

namespace App\Domain\Score;

class ScoreFlatComplete extends ScoreCompleteAbstract
{
    const DEFAULT_SCORE = 40;

    public function __invoke(): int
    {
        if ($this->ad->getTypology() != self::TYPOLOGY_FLAT) {
            return 0;
        }

        return $this->hasDescription() && $this->hasPictures() && $this->hasHouseSize() ? self::DEFAULT_SCORE : 0;
    }
}
