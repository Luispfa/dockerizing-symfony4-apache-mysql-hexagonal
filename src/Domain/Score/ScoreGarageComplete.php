<?php

declare(strict_types=1);

namespace App\Domain\Score;

class ScoreGarageComplete extends ScoreCompleteAbstract
{
    const DEFAULT_SCORE = 40;

    public function __invoke(): int
    {
        if ($this->ad->getTypology() != self::TYPOLOGY_GARAGE) {
            return 0;
        }

        return  $this->hasPictures() ? self::DEFAULT_SCORE : 0;
    }
}
