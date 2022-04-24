<?php

declare(strict_types=1);

namespace App\Domain\Score;

use App\Domain\Picture;
use function Lambdish\Phunctional\search as PhunctionalSearch;

final class ScorePicture extends ScoreAbstract
{
    const SD = 'SD';
    const HD = 'HD';
    const DEFAULT_SCORE_MIN = -10;
    const DEFAULT_SCORE_SD = 10;
    const DEFAULT_SCORE_HD = 20;

    public function __invoke(array $pictures): int
    {
        if (!count($this->ad->getPictures())) {
            return self::DEFAULT_SCORE_MIN;
        }

        $score = 0;
        foreach ($this->ad->getPictures() as $pictureId) {
            $pic = PhunctionalSearch(function (Picture $picture) use ($pictureId) {
                return $pictureId == $picture->getId();
            }, $pictures);

            if ($pic->getQuality() == self::SD) {
                $score = $score + self::DEFAULT_SCORE_SD;
            } else if ($pic->getQuality() == self::HD) {
                $score = $score + self::DEFAULT_SCORE_HD;
            }
        }

        return $score;
    }
}
