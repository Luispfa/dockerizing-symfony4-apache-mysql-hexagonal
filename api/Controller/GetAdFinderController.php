<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\Bus\Query\AdFinderQuery;
use App\Domain\Bus\Query\QueryHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetAdFinderController
{
    private $queryHandler;

    public function __construct(QueryHandler $queryHandler)
    {
        $this->queryHandler = $queryHandler;
    }

    /**
     * @Route("/get-ad/{id}", name="get-ad", methods={"GET"})
     */
    public function getAdFinder(Request $request): JsonResponse
    {
        $query = $this->queryHandler;
        $response = $query(new AdFinderQuery((int)$request->get('id')));

        return new JsonResponse($response->ads());
    }
}
