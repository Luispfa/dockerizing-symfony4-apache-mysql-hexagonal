<?php

declare(strict_types=1);

namespace App\Domain;

final class GetAd
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AdId $id): ?Ad
    {
        $ad = $this->repository->searchAd($id);
        if ($ad === null) {
            throw new \InvalidArgumentException("Ad with ID {$id->__toString()} not found");
        }

        return $ad;
    }
}
