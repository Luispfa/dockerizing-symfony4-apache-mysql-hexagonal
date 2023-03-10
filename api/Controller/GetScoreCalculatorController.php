<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\AdAllFinder;
use App\Application\ScoreCalculator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetScoreCalculatorController
{
    private $scoreCalculator;
    private $adAllFinder;

    public function __construct(ScoreCalculator $scoreCalculator, AdAllFinder $adAllFinder)
    {
        $this->scoreCalculator = $scoreCalculator;
        $this->adAllFinder = $adAllFinder;
    }

    /**
     * @Route("/calculate-score", name="calculate-score", methods={"GET"})
     */
    public function getCalculateScore(): JsonResponse
    {
        $this->scoreCalculator->__invoke();

        $getAll = $this->adAllFinder->__invoke();

        return new JsonResponse($getAll->ads());
    }
}
