<?php

declare(strict_types=1);

namespace App\Domain;

use function Lambdish\Phunctional\filter as PhunctionalFilter;

final class QualityListAd
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return PhunctionalFilter(
            function (Ad $ad) {
                return $ad->getScore() < Ad::RELEVANT_SCORE;
            },
            $this->repository->getAds()
        );
    }
}
