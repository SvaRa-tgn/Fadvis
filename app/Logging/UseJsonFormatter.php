<?php

declare(strict_types = 1);

namespace App\Logging;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\BufferHandler;

class UseJsonFormatter
{
    public function __invoke($monolog): void
    {
        $jsonFormatter = new JsonFormatter();
        /** @var BufferHandler[] $handlers */
        $handlers = $monolog->getHandlers();

        foreach ($handlers as $handler) {
            $handler->setFormatter($jsonFormatter);
        }
    }
}
