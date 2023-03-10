<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Score;

final class ScoreAd
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): void
    {
        $ads = $this->repository->getAds();
        foreach ($ads as $ad) {
            $score = $this->getScore($ad);
            $ad->setScore($score);
            $this->repository->updateScore($ad);
        }
    }

    private function getScore(Ad $ad): int
    {
        $pictures = $this->repository->getPictures();

        $score = (new Score\ScorePicture($ad))->__invoke($pictures);
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
