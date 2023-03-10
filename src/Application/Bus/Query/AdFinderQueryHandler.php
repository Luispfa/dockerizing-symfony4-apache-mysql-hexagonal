<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\AdId;
use App\Domain\Bus\Query\QueryHandler;
use App\Domain\GetAd;

final class AdFinderQueryHandler implements QueryHandler
{
    private $getAd;

    public function __construct(GetAd $getAd)
    {
        $this->getAd = $getAd;
    }

    public function __invoke(AdFinderQuery $query)
    {
        $id  = new AdId($query->id());

        return $this->getAd->__invoke($id);
    }
}
