<?php

namespace app\vos;

class ListVO
{
    /** @var ItemPreviewVO[] */
    private array $items;
    private ?PageVO $nextPage;
    private ?PageVO $prevPage;

    public function __construct(
        array $items = [],
        ?PageVO $nextPage = null,
        ?PageVO $prevPage = null
    ) {
        $this->items = $items;
        $this->nextPage = $nextPage;
        $this->prevPage = $prevPage;
    }

    public function getItems(): ?array
    {
        return $this->items;
    }

    public function hasNextPage(): bool
    {
        return !!$this->nextPage;
    }

    public function getNextPage(): ?PageVO
    {
        return $this->nextPage;
    }

    public function hasPrevPage(): bool
    {
        return !!$this->prevPage;
    }

    public function getPrevPage(): ?PageVO
    {
        return $this->prevPage;
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
