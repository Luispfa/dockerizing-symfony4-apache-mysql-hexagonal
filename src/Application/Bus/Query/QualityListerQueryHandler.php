<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

use App\Domain\QualityListAd;

final class QualityListerQueryHandler
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
