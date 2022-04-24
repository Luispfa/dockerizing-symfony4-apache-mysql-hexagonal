<?php

declare(strict_types=1);

namespace App\Domain\Score;

use App\Domain\Ad;

abstract class ScoreAbstract
{
    protected $ad;

    const TYPOLOGY_CHALET = 'CHALET';
    const TYPOLOGY_FLAT = 'FLAT';
    const TYPOLOGY_GARAGE = 'GARAGE';

    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }
}
