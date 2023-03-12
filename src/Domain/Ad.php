<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Aggregate\AggregateRoot;
use DateTimeImmutable;

final class Ad extends AggregateRoot
{
    private  $id, $typology, $description, $pictures, $houseSize, $gardenSize, $score, $irrelevantSince;
    const RELEVANT_SCORE = 40;

    public function __construct(
        AdId $id,
        AdTypology $typology,
        String $description,
        array $pictures,
        ?int $houseSize = null,
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

    public function getId(): AdId
    {
        return $this->id;
    }

    public function getTypology(): AdTypology
    {
        return $this->typology;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPictures(): array
    {
        return $this->pictures;
    }

    public function getHouseSize(): ?int
    {
        return $this->houseSize;
    }

    public function getGardensize(): ?int
    {
        return $this->gardenSize;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getIrrelevantSince(): ?DateTimeImmutable
    {
        return $this->irrelevantSince;
    }

    public  function toArray(): array
    {
        return  [
            $this->getId()->value() => [
                'id' => $this->getId()->value(),
                'typology' => $this->getTypology()->value(),
                'description' => $this->getDescription(),
                'pictures' => $this->getPictures(),
                'houseSize' => $this->getHouseSize(),
                'gardenSize' => $this->getGardensize(),
                'score' => $this->getScore(),
                'irrelevantSince' => $this->getIrrelevantSince() ? $this->getIrrelevantSince()->format('Y-m-d H:i:s') : null
            ]
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new AdId($data['id']),
            new AdTypology($data['typology']),
            $data['description'],
            $data['pictures'],
            $data['houseSize'],
            $data['gardenSize'],
            $data['score'],
            $data['irrelevantSince'] ? new DateTimeImmutable($data['irrelevantSince']) : null
        );
    }
}
