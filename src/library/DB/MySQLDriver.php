<?php

declare(strict_types=1);

namespace RenanRoble\Exads\DB;

class MySQLDriver implements DriverInterface
{
    public function getDSN(): string
    {
        return sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME);
    }
}
