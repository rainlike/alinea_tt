<?php

namespace app\interfaces;

interface ILogger
{
    public function info(string $url, ?string $message = null): void;

    public function error(string $url, ?string $message = null): void;
}
