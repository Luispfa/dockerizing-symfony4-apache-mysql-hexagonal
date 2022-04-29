<?php

declare(strict_types = 1);

namespace App\Domain;

interface SystemPersistenceRepository
{
    public function getAds(): array;

    public function getPictures(): array;

    public function searchAd(AdId $id): Ad;
}