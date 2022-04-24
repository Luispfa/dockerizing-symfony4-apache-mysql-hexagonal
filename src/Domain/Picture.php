<?php

declare(strict_types=1);

namespace App\Domain;

final class Picture
{
    private $id, $url, $quality;

    public function __construct(
        int $id,
        String $url,
        String $quality
    ) {
        $this->id = $id;
        $this->url = $url;
        $this->quality = $quality;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getQuality(): string
    {
        return $this->quality;
    }
}
