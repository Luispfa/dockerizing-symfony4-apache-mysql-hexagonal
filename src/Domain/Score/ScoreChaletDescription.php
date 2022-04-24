<?php

declare(strict_types=1);

namespace App\Domain\Score;

final class ScoreChaletDescription extends ScoreAbstract
{
    const DEFAULT_SCORE = 20;
    const MAX_NUM_WORDS = 50;

    public function __invoke(): int
    {
        if ($this->ad->getTypology() != self::TYPOLOGY_CHALET) {
            return 0;
        }

        $num = str_word_count($this->ad->getDescription(), 0);

        return $num > self::MAX_NUM_WORDS ? self::DEFAULT_SCORE : 0;
    }
}
