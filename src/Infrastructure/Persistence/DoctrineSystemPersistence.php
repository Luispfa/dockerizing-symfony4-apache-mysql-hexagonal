<?php

declare(strict_types = 1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\AdId;
use App\Domain\Picture;
use App\Domain\SystemPersistenceRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineSystemPersistence extends DoctrineRepository implements SystemPersistenceRepository
{
    public function getAds(): array
    {
        return $this->repository(Ad::class)->findAll();
    }

    public function getPictures(): array
    {
        return $this->repository(Picture::class)->findAll();
    }

    public function searchAd(AdId $id): ?Ad
    {
        return $this->repository(Ad::class)->find($id);
    }

    public function updateScore(Ad $ad): void
    {
        $this->persist($ad);
    }
}