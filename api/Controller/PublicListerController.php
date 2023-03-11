<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\PublicLister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PublicListerController
{
    private $publicLister;

    public function __construct(PublicLister $publicLister)
    {
        $this->publicLister = $publicLister;
    }

    /**
     * @Route("/public-listing", name="public-listing")
     */
    public function PublicLister(): JsonResponse
    {
        return new JsonResponse($this->publicLister->__invoke()->ads());
    }
}
