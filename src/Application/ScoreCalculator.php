<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Command\ScoreCalculatorCommandHandler;
use App\Application\Bus\Query\AdAllFinderQueryHandler;
use App\Application\Response\AdResponse;
use App\Application\Response\AdsResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class ScoreCalculator
{
    private $scoreCalculatorCommandHandler;
    private $adAllFinderQueryHandler;

    public function __construct(
        AdAllFinderQueryHandler $adAllFinderQueryHandler,
        ScoreCalculatorCommandHandler $scoreCalculatorCommandHandler
    )
    {
        $this->adAllFinderQueryHandler = $adAllFinderQueryHandler;
        $this->scoreCalculatorCommandHandler = $scoreCalculatorCommandHandler;
    }

    public function __invoke(): AdsResponse
    {
        $this->scoreCalculatorCommandHandler->__invoke();
        $ad = $this->adAllFinderQueryHandler->__invoke();
        
        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), $ad));
    }
}
