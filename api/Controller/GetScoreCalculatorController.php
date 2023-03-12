<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\ScoreCalculator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetScoreCalculatorController
{
    private $scoreCalculator;

    public function __construct(ScoreCalculator $scoreCalculator)
    {
        $this->scoreCalculator = $scoreCalculator;
    }

    /**
     * @Route("/calculate-score", name="calculate-score", methods={"GET"})
     */
    public function getCalculateScore(): JsonResponse
    {
        $getAll = $this->scoreCalculator->__invoke();

        return new JsonResponse($getAll->ads());
    }
}
