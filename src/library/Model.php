<?php

declare(strict_types=1);

namespace RenanRoble\Exads;

use DateTime;
use RenanRoble\Exads\DB;

abstract class Model
{
    public static string $table;
    protected static $instance;

    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    protected static $casts = [];

    /**
     * Return the Database instance
     *
     * @return self
     */
    public static function getInstance(): self
    {
        $class = get_called_class();
        if (!$class::$instance)
            $class::$instance = new $class;
        return  $class::$instance;
    }

    /**
     * query
     *
     * @param  string $query
     * @param  array $params
     * @return array
     */
    public static function query(string $query, array $params = []): array
    {
        $stmt = DB::getInstance()
            ->run($query, $params);

        return $stmt ? $stmt->fetchAll() : [];
    }


    /**
     * Cast the values to the correct type
     *
     * Only datetime cast implemented
     * 
     * @param  array $data
     * @return array 
     */
    public static function cast(array $data): array
    {
        $result = [];
        foreach ($data as $k => $row) {
            foreach ($row as $key => $value) {
                if (isset(static::$casts[$key])) {
                    switch (static::$casts[$key]) {
                        case 'datetime':
                            $result[$k][$key] = new DateTime($value);
                            break;
                        default:
                            $result[$k][$key] = $value;
                            break;
                    }
                } else
                    $result[$k][$key] = $value;
            }
        }
        return $result;
    }
}
