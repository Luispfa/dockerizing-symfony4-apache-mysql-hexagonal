<?php

declare(strict_types=1);

namespace App\Domain;

use function Lambdish\Phunctional\filter as PhunctionalFilter;
use function Lambdish\Phunctional\sort as PhunctionalSort;

final class PublicListAd
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $newAds = PhunctionalFilter(
            function (Ad $ad) {
                return $ad->getScore() >= Ad::RELEVANT_SCORE;
            },
            $this->repository->getAds()
        );


        return PhunctionalSort(
            function (Ad $one, Ad $other) {
                return $one->getScore() < $other->getScore();
            },
            $newAds
        );
    }
}
