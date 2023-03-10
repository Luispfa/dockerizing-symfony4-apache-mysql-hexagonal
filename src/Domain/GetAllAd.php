<?php

declare(strict_types=1);

namespace App\Domain;

final class GetAllAd
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $ads = $this->repository->getAds();
        if (empty($ads)) {
            throw new \InvalidArgumentException("Ads not found");
        }

        return $ads;
    }
}
