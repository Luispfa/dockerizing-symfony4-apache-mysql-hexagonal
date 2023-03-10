<?php

declare(strict_types=1);

namespace App\Application\Response;

final class AdsResponse
{
    private  $ads;

    public function __construct(array ...$ads)
    {
        $this->ads = $ads;
    }

    public function ads(): array
    {
        return $this->ads;
    }
}
