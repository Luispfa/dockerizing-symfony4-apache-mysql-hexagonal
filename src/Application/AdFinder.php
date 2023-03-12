<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Command\ScoreCalculatorCommandHandler;
use App\Application\Bus\Query\AdFinderQuery;
use App\Application\Bus\Query\AdFinderQueryHandler;
use App\Application\Response\AdsResponse;
use App\Application\Response\AdResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class AdFinder
{
    private $adFinderQueryHandler;
    private $scoreCalculatorCommandHandler;

    public function __construct(
        AdFinderQueryHandler $adFinderQueryHandler,
        ScoreCalculatorCommandHandler $scoreCalculatorCommandHandler
    ) {
        $this->adFinderQueryHandler = $adFinderQueryHandler;
        $this->scoreCalculatorCommandHandler = $scoreCalculatorCommandHandler;
    }

    public function __invoke(int $id): AdsResponse
    {
        $this->scoreCalculatorCommandHandler->__invoke();

        $query = new AdFinderQuery($id);
        $ad = $this->adFinderQueryHandler->__invoke($query);

        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), [$ad]));
    }
}
