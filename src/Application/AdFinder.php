<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\AdId;
use App\Application\Response\AdsResponse;
use App\Application\Response\AdResponse;
use App\Domain\SystemPersistenceRepository;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class AdFinder
{
    private $repository;

    public function __construct(SystemPersistenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AdId $id): AdsResponse
    {
        $ad = $this->repository->searchAd($id);
        
        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), [$ad]));
    }
}
