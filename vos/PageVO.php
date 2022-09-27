<?php

namespace app\vos;

class PageVO
{
    private float $offset;
    private string $path;
    private string $uri;

    public function __construct(
        float $offset,
        string $path,
        string $uri
    ) {
        $this->offset = $offset;
        $this->path = $path;
        $this->uri = $uri;
    }

    public function getOffset(): float
    {
        return $this->offset;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getUri(): string
    {
        return $this->uri;
    }
}
