<?php

declare(strict_types=1);

namespace App\Domain\Score;

final class ScoreAssetsDescription extends ScoreAbstract
{
    private $assets = ['Luminoso', 'Nuevo', 'Céntrico', 'Reformado', 'Ático'];

    const DEFAULT_SCORE = 5;

    public function __invoke(): int
    {
        $score = 0;

        foreach ($this->assets as $asset) {
            $repetitions = substr_count(ucwords($this->ad->getDescription()), $asset);
            $score += self::DEFAULT_SCORE * $repetitions;
        }

        return $score;
    }
}
