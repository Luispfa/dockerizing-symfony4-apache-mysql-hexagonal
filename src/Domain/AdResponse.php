<?php

declare(strict_types=1);

namespace App\Domain;

use DateTimeImmutable;

final class AdResponse
{
    private  $id, $typology, $description, $pictures, $houseSize, $gardenSize, $score, $irrelevantSince;

    public function __construct(
        int $id,
        String $typology,
        String $description,
        array $pictures,
        int $houseSize,
        ?int $gardenSize = null,
        ?int $score = null,
        ?DateTimeImmutable $irrelevantSince = null
    ) {
        $this->id = $id;
        $this->typology = $typology;
        $this->description = $description;
        $this->pictures = $pictures;
        $this->houseSize = $houseSize;
        $this->gardenSize = $gardenSize;
        $this->score = $score;
        $this->irrelevantSince = $irrelevantSince;
    }

    public function __invoke(): array
    {
        return [
            'id' => $this->id,
            'typology' => $this->typology,
            'description' => $this->description,
            'pictures' => $this->pictures,
            'houseSize' => $this->houseSize,
            'gardenSize' => $this->gardenSize,
            'score' => $this->score,
            'irrelevantSince' => $this->irrelevantSince
        ];
    }

    public static function toResponse()
    {
        return static function (Ad $ad) {
            $adResponse = new self(
                $ad->getId(),
                $ad->getTypology(),
                $ad->getDescription(),
                $ad->getPictures(),
                $ad->getHouseSize(),
                $ad->getGardensize(),
                $ad->getScore(),
                $ad->getIrrelevantSince()
            );

            return $adResponse();
        };
    }
}
