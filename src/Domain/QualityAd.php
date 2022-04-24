<?php

declare(strict_types=1);

namespace App\Domain;

use function Lambdish\Phunctional\filter as PhunctionalFilter;

final class QualityAd
{
    private $ads;

    public function __construct(array $ads)
    {
        $this->ads = $ads;
    }

    public function listing(): array
    {
        return PhunctionalFilter(
            function (Ad $ad) {
                return $ad->getScore() < Ad::RELEVANT_SCORE;
            },
            $this->ads
        );
    }
}
