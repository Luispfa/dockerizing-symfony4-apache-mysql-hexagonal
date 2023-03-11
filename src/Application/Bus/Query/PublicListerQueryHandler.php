<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\PublicListAd;

final class PublicListerQueryHandler implements QueryHandler
{
    private $publisList;

    public function __construct(PublicListAd $publisList)
    {
        $this->publisList = $publisList;
    }

    public function __invoke()
    {
        return $this->publisList->__invoke();
    }
}
