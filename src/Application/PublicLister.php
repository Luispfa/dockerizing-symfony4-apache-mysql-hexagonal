<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Query\PublicListerQueryHandler;
use App\Application\Response\AdResponse;
use App\Application\Response\AdsResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class PublicLister
{
    private $queryHandler;

    public function __construct(PublicListerQueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    public function __invoke(): AdsResponse
    {
        $ad = $this->queryHandler->__invoke();

        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), $ad));
    }
}
