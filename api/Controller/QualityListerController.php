<?php

declare(strict_types=1);

namespace Api\Controller;

use App\Application\QualityLister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

final class QualityListerController
{
    private $qualityLister;

    public function __construct(QualityLister $qualityLister)
    {
        $this->qualityLister = $qualityLister;
    }

    /**
     * @Route("/quality-listing", name="quality-listing")
     */
    public function QualityLister(): JsonResponse
    {
        return new JsonResponse($this->qualityLister->__invoke()->ads());
    }
}
