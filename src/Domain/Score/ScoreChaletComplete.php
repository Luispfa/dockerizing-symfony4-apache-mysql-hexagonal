<?php

declare(strict_types=1);

namespace App\Domain\Score;

class ScoreChaletComplete extends ScoreCompleteAbstract
{
    const DEFAULT_SCORE = 40;

    public function __invoke(): int
    {
        if ($this->ad->getTypology() != self::TYPOLOGY_CHALET) {
            return 0;
        }

        return $this->hasDescription() && $this->hasPictures() && $this->hasHouseSize() && !empty($this->ad->getGardensize()) ? self::DEFAULT_SCORE : 0;
    }
}
