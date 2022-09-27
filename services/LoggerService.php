<?php

namespace app\services;

use app\entities\Log;
use app\interfaces\ILogger;

class LoggerService implements ILogger
{
    public function info(string $url, ?string $message = null): void
    {
        $model = new Log();
        $model->status = Log::STATUS_INFO;
        $model->url = $url;
        $model->message = $message;
        $model->save();
    }

    public function error(string $url, ?string $message = null): void
    {
        $model = new Log();
        $model->status = Log::STATUS_ERROR;
        $model->url = $url;
        $model->message = $message;
        $model->save();
    }
}
