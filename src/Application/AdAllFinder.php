<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Query\AdAllFinderQueryHandler;
use App\Application\Response\AdsResponse;
use App\Application\Response\AdResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class AdAllFinder
{
    private $queryHandler;

    public function __construct(AdAllFinderQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(): AdsResponse
    {
        $ad = $this->queryHandler->__invoke();
        
        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), $ad));
    }
}
