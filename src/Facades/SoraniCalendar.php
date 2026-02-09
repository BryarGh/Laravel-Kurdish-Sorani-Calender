<?php

namespace BryarGhafoor\SoraniCalendar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array now()
 * @method static array convert($date = null)
 * @method static bool isLeapYear(int $year)
 * @method static string format(array $date, string $format = 'full')
 * @method static array getMonthNames()
 * @method static array getDayNames()
 * 
 * @see \BryarGhafoor\SoraniCalendar\SoraniCalendar
 */
class SoraniCalendar extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sorani-calendar';
    }
}
