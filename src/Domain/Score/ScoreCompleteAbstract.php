<?php

declare(strict_types=1);

namespace App\Domain\Score;

abstract class ScoreCompleteAbstract extends ScoreAbstract
{
    public function hasDescription(): bool
    {
        return !empty($this->ad->getDescription());
    }

    public function hasPictures(): bool
    {
        return count($this->ad->getPictures()) ?  true : false;
    }

    public function hasHouseSize(): bool
    {
        return !empty($this->ad->getHouseSize()) || $this->ad->getHouseSize() != 0;
    }
}
