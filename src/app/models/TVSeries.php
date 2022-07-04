<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use RenanRoble\Exads\Model;

class TVSeries extends Model
{
    public static string $table = 'tv_series';

    protected static $casts = [
        'next_show_time' => 'datetime',
    ];

    /**
     * Get the next tv series that will air
     *
     * @param  string $datetime Format: Y-m-d H:i:s
     * @param  string $title
     * @return array
     */
    public static function getNextWillAir(string $datetime = '', string $title = '', int $limit = 5): array
    {

        $table =  TVSeriesIntervals::$table;
        $joinTable = self::$table;

        // Check the diff between the given datetime and the next show time using the weekday
        // if the subtract is less than 0, then subtract the diff from 7 to get the next show time
        // else use the diff. 
        $query =  "SELECT id, title, channel, gender, week_day, show_time,  
                        DATE_ADD(CONCAT(:date, ' ', show_time),
                        INTERVAL IF(
                            week_day - WEEKDAY(:date) < 0,
                            7 + week_day - WEEKDAY(:date),
                            week_day - WEEKDAY(:date)
                        ) DAY) AS next_show_time
                    FROM {$table} 
                    INNER JOIN {$joinTable} 
                    ON {$table}.id_tv_series = {$joinTable}.id
                    HAVING next_show_time >= :datetime ";

        $now = new DateTime();
        $datetime = new DateTime($datetime ?? 'now');

        // don't show tv series that already aired
        if ($datetime < $now) return [];

        $params = [
            'date' => $datetime->format('Y-m-d'),
            'datetime' => $datetime->format('Y-m-d H:i:s')
        ];

        if ($title = trim($title)) {
            $query .= " AND MATCH(title) AGAINST(:title IN BOOLEAN MODE) ";
            $params['title'] = $title . '*';
        }

        $query .= " ORDER BY next_show_time ASC";

        if ($limit)
            $query .= " LIMIT {$limit}";

        return static::cast(self::query($query, $params));
    }
}
