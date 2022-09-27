<?php
namespace app\commands;

use app\services\TenderService;
use DomainException;
use yii\console\Controller;
use yii\helpers\Console;
use yii\console\ExitCode;

class TenderController extends Controller
{
    private TenderService $service;

    public function __construct($id, $module, ?array $config, TenderService $service)
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $pageLimit = 2;

        Console::stdout('Start the process...' . PHP_EOL);
        $time = microtime(true);

        try {
            $this->service->setPageLimit($pageLimit)->process();
        } catch (DomainException $e) {
            Console::stderr('Exception: "' . $e->getMessage() . '"' . PHP_EOL);
        }

        Console::stdout('Taking time: ' . (microtime(true) - $time) . PHP_EOL);

        return ExitCode::OK;
    }
}
