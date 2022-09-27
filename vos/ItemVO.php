<?php

namespace app\vos;

class ItemVO
{
    private string $tenderId;
    private float $amount;
    private string $dateModified;
    private ?string $description;

    public function __construct(
        string $tenderId,
        float $amount,
        string $dateModified,
        ?string $description = null
    ) {
        $this->tenderId = $tenderId;
        $this->amount = $amount;
        $this->dateModified = $dateModified;
        $this->description = $description;
    }

    public function getTenderId(): string
    {
        return $this->tenderId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDateModified(): string
    {
        return $this->dateModified;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
