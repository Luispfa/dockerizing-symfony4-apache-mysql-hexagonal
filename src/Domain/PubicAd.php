<?php

declare(strict_types=1);

namespace App\Domain;

use function Lambdish\Phunctional\filter as PhunctionalFilter;
use function Lambdish\Phunctional\sort as PhunctionalSort;

final class PubicAd
{
    private $ads;

    public function __construct(array $ads)
    {
        $this->ads = $ads;
    }

    public function listing(): array
    {
        $newAds = PhunctionalFilter(
            function (Ad $ad) {
                return $ad->getScore() >= Ad::RELEVANT_SCORE;
            },
            $this->ads
        );


        return PhunctionalSort(
            function (Ad $one, Ad $other) {
                return $one->getScore() < $other->getScore();
            },
            $newAds
        );
    }
}
