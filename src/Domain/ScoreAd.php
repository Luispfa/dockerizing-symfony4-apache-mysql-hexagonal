<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Score;

final class ScoreAd
{
    private  $pictures, $ads;

    public function __construct(array $ads, array $pictures)
    {
        $this->ads = $ads;
        $this->pictures = $pictures;
    }

    public function calculate(): array
    {
        $array = [];
        foreach ($this->ads as $ad) {
            $score = $this->getScore($ad);
            $ad->setScore($score);
            $array[] = $ad;
        }

        return $array;
    }

    private function getScore(Ad $ad): int
    {
        $score = (new Score\ScorePicture($ad))->__invoke($this->pictures);
        $score += (new Score\ScoreDescription($ad))->__invoke();
        $score += (new Score\ScoreFlatDescription($ad))->__invoke();
        $score += (new Score\ScoreChaletDescription($ad))->__invoke();
        $score += (new Score\ScoreAssetsDescription($ad))->__invoke();
        $score += (new Score\ScoreFlatComplete($ad))->__invoke();
        $score += (new Score\ScoreChaletComplete($ad))->__invoke();
        $score += (new Score\ScoreGarageComplete($ad))->__invoke();

        return $this->setScore($score);
    }

    private function setScore(int $score): int
    {
        if ($score < 0) {
            return 0;
        }

        if ($score > 100) {
            return 100;
        }

        return $score;
    }
}
