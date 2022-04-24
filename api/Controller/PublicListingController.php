<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\PublicListing;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PublicListingController
{
    private $listing;

    public function __construct(PublicListing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * @Route("/public-listing", name="public-listing")
     */
    public function PublicListing(): JsonResponse
    {
        return new JsonResponse($this->listing->__invoke()->ads());
    }
}
