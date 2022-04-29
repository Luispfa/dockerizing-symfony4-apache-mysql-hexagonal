<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Application\AdFinder;
use App\Domain\AdId;
use App\Domain\Bus\Query\QueryHandler;

final class AdFinderQueryHandler implements QueryHandler
{
    private $adFinder;

    public function __construct(AdFinder $adFinder)
    {
        $this->adFinder = $adFinder;
    }

    public function __invoke(AdFinderQuery $query)
    {
        $id  = new AdId($query->id());

        return $this->adFinder->__invoke($id);
    }
}
