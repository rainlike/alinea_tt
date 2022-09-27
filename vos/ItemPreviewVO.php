<?php

namespace app\vos;

class ItemPreviewVO
{
    private string $id;
    private string $dateModified;

    public function __construct(string $id, string $dateModified)
    {
        $this->id = $id;
        $this->dateModified = $dateModified;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDateModified(): string
    {
        return $this->dateModified;
    }
}
