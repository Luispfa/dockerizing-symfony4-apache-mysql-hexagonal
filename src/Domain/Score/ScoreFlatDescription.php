<?php

declare(strict_types=1);

namespace App\Domain\Score;

final class ScoreFlatDescription extends ScoreAbstract
{
    const DEFAULT_SCORE_ONE = 10;
    const DEFAULT_SCORE_TWO = 30;
    const MIN_NUM_WORDS = 20;
    const MAX_NUM_WORDS = 50;

    public function __invoke(): int
    {
        $score = 0;
        if ($this->ad->getTypology() != self::TYPOLOGY_FLAT) {
            return $score;
        }

        $num = str_word_count($this->ad->getDescription(), 0);
        if ($num >= self::MIN_NUM_WORDS && $num < self::MAX_NUM_WORDS) {
            $score = self::DEFAULT_SCORE_ONE;
        } else if ($num >= self::MAX_NUM_WORDS) {
            $score = self::DEFAULT_SCORE_TWO;
        }

        return $score;
    }
}
