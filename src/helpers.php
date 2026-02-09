<?php

use BryarGhafoor\SoraniCalendar\Facades\SoraniCalendar;

if (!function_exists('sorani_calendar')) {
    /**
     * Convert Gregorian date to Sorani Kurdish calendar
     *
     * @param string|DateTimeInterface|null $date
     * @return array
     */
    function sorani_calendar($date = null): array
    {
        return SoraniCalendar::convert($date);
    }
}

if (!function_exists('sorani_now')) {
    /**
     * Get current date in Sorani Kurdish calendar
     *
     * @return array
     */
    function sorani_now(): array
    {
        return SoraniCalendar::now();
    }
}

if (!function_exists('sorani_format')) {
    /**
     * Format a Sorani Kurdish date
     *
     * @param array $date
     * @param string $format
     * @return string
     */
    function sorani_format(array $date, string $format = 'full'): string
    {
        return SoraniCalendar::format($date, $format);
    }
}

if (!function_exists('sorani_month_names')) {
    /**
     * Get all Sorani Kurdish month names
     *
     * @return array
     */
    function sorani_month_names(): array
    {
        return SoraniCalendar::getMonthNames();
    }
}

if (!function_exists('sorani_day_names')) {
    /**
     * Get all Sorani Kurdish day names
     *
     * @return array
     */
    function sorani_day_names(): array
    {
        return SoraniCalendar::getDayNames();
    }
}
