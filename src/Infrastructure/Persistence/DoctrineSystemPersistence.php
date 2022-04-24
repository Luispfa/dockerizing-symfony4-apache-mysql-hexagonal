<?php

declare(strict_types = 1);

namespace App\Infrastructure\Persistence;

use App\Domain\Ad;
use App\Domain\Picture;
use App\Domain\SystemPersistenceRepository;
use App\Infrastructure\Persistence\Doctrine\DoctrineRepository;

class DoctrineSystemPersistence extends DoctrineRepository implements SystemPersistenceRepository
{
    public function getAds(): array
    {

        return $this->searchAll(Ad::class);
    }

    public function getPictures(): array
    {
        return $this->searchAll(Picture::class);
    }
}