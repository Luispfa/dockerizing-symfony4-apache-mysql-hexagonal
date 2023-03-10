<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Query\AdFinderQuery;
use App\Application\Bus\Query\AdFinderQueryHandler;
use App\Application\Response\AdsResponse;
use App\Application\Response\AdResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class AdFinder
{
    private $queryHandler;

    public function __construct(AdFinderQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(int $id): AdsResponse
    {
        $query = new AdFinderQuery($id);

        $ad = $this->queryHandler->__invoke($query);
        
        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), [$ad]));
    }
}
