<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\GetAllAd;

final class AdAllFinderQueryHandler implements QueryHandler
{
    private $getAllAd;

    public function __construct(GetAllAd $getAllAd)
    {
        $this->getAllAd = $getAllAd;
    }

    public function __invoke()
    {
        return $this->getAllAd->__invoke();
    }
}
