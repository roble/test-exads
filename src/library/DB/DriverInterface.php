<?php

declare(strict_types=1);

namespace RenanRoble\Exads\DB;

interface DriverInterface
{
    public function getDSN(): string;
}
