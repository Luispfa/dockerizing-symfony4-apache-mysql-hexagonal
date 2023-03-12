<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Bus\Command\ScoreCalculatorCommandHandler;
use App\Application\Bus\Query\PublicListerQueryHandler;
use App\Application\Response\AdResponse;
use App\Application\Response\AdsResponse;
use function Lambdish\Phunctional\map as PhunctionalMap;

final class PublicLister
{
    private $publicListerQueryHandler;
    private $scoreCalculatorCommandHandler;

    public function __construct(
        PublicListerQueryHandler $publicListerQueryHandler,
        ScoreCalculatorCommandHandler $scoreCalculatorCommandHandler
    ) {
        $this->publicListerQueryHandler = $publicListerQueryHandler;
        $this->scoreCalculatorCommandHandler = $scoreCalculatorCommandHandler;
    }

    public function __invoke(): AdsResponse
    {
        $this->scoreCalculatorCommandHandler->__invoke();
        $ad = $this->publicListerQueryHandler->__invoke();

        return new AdsResponse(...PhunctionalMap(AdResponse::toResponse(), $ad));
    }
}
