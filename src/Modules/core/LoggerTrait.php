<?php
namespace MiniStore\Modules\Core;

use MiniStore\Config;

trait LoggerTrait {
    protected function log(string $message): void {
        file_put_contents(Config::LOG_FILE, date('[Y-m-d H:i:s] ') . $message . PHP_EOL, FILE_APPEND);
    }
}
