<?php

namespace app\services;

use app\vos\ItemPreviewVO;
use app\vos\ItemVO;
use app\vos\ListVO;
use app\vos\PageVO;
use DomainException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use yii\helpers\Json;

class TenderApiService
{
    public const XXX_URL = 'https://public.api.openprocurement.org/api/0/tenders?descending=1';
    public const API_URL = 'https://public.api.openprocurement.org/api/0/';
    public const DEFAULT_LIST_URI = 'tenders?descending=1';
    public const ITEM_DETAIL_URI = 'tenders/{{id}}';

    private Client $client;
    private LoggerService $loggerService;

    public function __construct(Client $client, LoggerService $loggerService)
    {
        $this->client = $client;
        $this->loggerService = $loggerService;
    }

    public function getList(string $pageUri): ListVO
    {
        $url = $this->getListUrl($pageUri);

        try {
            $response = $this->client->get($url);
            $responseContent = Json::decode($response->getBody()->getContents());
            $this->loggerService->info($url);

            $nextPage = !empty($responseContent['next_page'])
                ? new PageVO(
                    $responseContent['next_page']['offset'],
                    $responseContent['next_page']['path'],
                    $responseContent['next_page']['uri']
                )
                : null;
            $prevPage = !empty($responseContent['prev_page'])
                ? new PageVO(
                    $responseContent['prev_page']['offset'],
                    $responseContent['prev_page']['path'],
                    $responseContent['prev_page']['uri']
                )
                : null;
            $items = !empty($responseContent['data'])
                ? array_map(
                    fn(array $element) => new ItemPreviewVO(
                        $element['id'],
                        $element['dateModified']
                    ),
                    $responseContent['data']
                )
                : [];

            return new ListVO($items, $nextPage, $prevPage);
        } catch (GuzzleException $e) {
            $this->loggerService->error($url, $e->getMessage());
            throw new DomainException($e->getMessage());
        }

    }

    public function getItem(string $itemUri): ItemVO
    {
        $url = $this->getItemUrl($itemUri);

        try {
            $response = $this->client->get($url);
            $responseContent = Json::decode($response->getBody()->getContents());
            $this->loggerService->info($url);

            return new ItemVO(
                $responseContent['data']['tenderID'],
                $responseContent['data']['value']['amount'],
                $responseContent['data']['dateModified'],
                $responseContent['data']['description'] ?? null
            );
        } catch (GuzzleException $e) {
            $this->loggerService->error($url, $e->getMessage());
            throw new DomainException($e->getMessage());
        }
    }

    private function getListUrl(string $pageUri): string
    {
        return $pageUri ?: self::API_URL . self::DEFAULT_LIST_URI;
    }

    private function getItemUrl(string $itemId): string
    {
        return self::API_URL . str_replace('{{id}}', $itemId, self::ITEM_DETAIL_URI);
    }
}
