<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Command\ScoreCalculatorCommandHandler;
use App\Application\Bus\Query\QualityListerQueryHandler;
use App\Application\Response\AdResponse;
use App\Application\Response\AdsResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class QualityLister
{
    private $qualityListerQueryHandler;
    private $scoreCalculatorCommandHandler;

    public function __construct(
        QualityListerQueryHandler $qualityListerQueryHandler,
        ScoreCalculatorCommandHandler $scoreCalculatorCommandHandler
    ) {
        $this->qualityListerQueryHandler = $qualityListerQueryHandler;
        $this->scoreCalculatorCommandHandler = $scoreCalculatorCommandHandler;
    }

    public function __invoke(): AdsResponse
    {
        $this->scoreCalculatorCommandHandler->__invoke();
        $ad = $this->qualityListerQueryHandler->__invoke();

        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), $ad));
    }
}
