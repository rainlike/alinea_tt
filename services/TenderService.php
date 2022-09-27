<?php

namespace app\services;

use app\entities\Tender;
use DomainException;

class TenderService
{
    private const MINIMAL_PAGE_LIMIT = 1;

    private int $pageLimit = 10;

    private TenderApiService $apiService;

    public function __construct(
        TenderApiService $apiService,
        LoggerService $loggerService
    ) {
        $this->apiService = $apiService;
        $this->loggerService = $loggerService;
    }

    public function setPageLimit(int $pageLimit): self
    {
        $this->pageLimit = max($pageLimit, self::MINIMAL_PAGE_LIMIT);
        return $this;
    }

    public function getPageLimit(): int
    {
        return $this->pageLimit;
    }

    public function process(?int $pageLimit = null): void
    {
        $pageLimit = $pageLimit ?: $this->pageLimit;

        $pageNumber = 0;
        $pageUri = '';
        do {
            try {
                $listResponse = $this->apiService->getList($pageUri);
                foreach ($listResponse->getItems() as $item) {
                    try {
                        $tenderInfo = $this->apiService->getItem($item->getId());
                        $tender = new Tender();
                        $tender->tender_id = $tenderInfo->getTenderId();
                        $tender->description = $tenderInfo->getDescription();
                        $tender->amount = $tenderInfo->getAmount();
                        $tender->date_modified = $tenderInfo->getDateModified();
                        $tender->save();
                    } catch (DomainException $e) {
                        throw new DomainException($e->getMessage());
                    }
                }
            } catch (DomainException $e) {
                throw new DomainException($e->getMessage());
            }

            $pageNumber++;
            $pageUri = $listResponse->getNextPage()->getUri();
        } while ($pageNumber <= $pageLimit);
    }
}
