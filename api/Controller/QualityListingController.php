<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\QualityListing;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QualityListingController
{
    private $listing;

    public function __construct(QualityListing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * @Route("/quality-listing", name="quality-listing")
     */
    public function QualityListing(): JsonResponse
    {
        return new JsonResponse($this->listing->__invoke()->ads());
    }
}
