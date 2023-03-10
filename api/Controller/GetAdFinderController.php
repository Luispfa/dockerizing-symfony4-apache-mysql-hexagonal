<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\AdFinder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetAdFinderController
{
    private $adFinder;

    public function __construct(AdFinder $adFinder)
    {
        $this->adFinder = $adFinder;
    }

    /**
     * @Route("/get-ad/{id}", name="get-ad", methods={"GET"})
     */
    public function getAdFinder(Request $request): JsonResponse
    {
        $response = $this->adFinder->__invoke((int)$request->get('id'));

        return new JsonResponse($response->ads());
    }
}
