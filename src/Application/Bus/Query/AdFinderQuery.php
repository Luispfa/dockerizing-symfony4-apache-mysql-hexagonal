<?php

declare(strict_types=1);

namespace App\Application\Bus\Query;

final class AdFinderQuery
{
    private  $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}
