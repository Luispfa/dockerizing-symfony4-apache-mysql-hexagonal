<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\Bus\Query\QueryHandler;
use App\Domain\QualityListAd;

final class QualityListerQueryHandler implements QueryHandler
{
    private $qualityList;

    public function __construct(QualityListAd $qualityList)
    {
        $this->qualityList = $qualityList;
    }

    public function __invoke()
    {
        return $this->qualityList->__invoke();
    }
}
