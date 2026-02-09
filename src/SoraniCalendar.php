<?php

namespace BryarGhafoor\SoraniCalendar;

use DateTime;
use DateTimeInterface;

class SoraniCalendar
{
    /**
     * Kurdish month names in Sorani dialect
     */
    private const MONTH_NAMES = [
        1 => 'خاکه‌لێوه',
        2 => 'گوڵان',
        3 => 'جۆزه‌ردان',
        4 => 'پووشپه‌ڕ',
        5 => 'گه‌لاوێژ',
        6 => 'خه‌رمانان',
        7 => 'ره‌زبه‌ر',
        8 => 'خه‌زه‌ڵوه‌ر',
        9 => 'سه‌رماوه‌ز',
        10 => 'به‌فرانبار',
        11 => 'رێبه‌ندان',
        12 => 'ره‌شه‌مێ',
    ];

    /**
     * Kurdish day names in Sorani dialect
     */
    private const DAY_NAMES = [
        0 => 'یه‌کشه‌ممه',
        1 => 'دووشه‌ممه',
        2 => 'سێشەممه',
        3 => 'چوارشه‌ممه',
        4 => 'پێنجشه‌ممه',
        5 => 'هه‌ینی',
        6 => 'شه‌ممه',
    ];

    /**
     * Days in each Gregorian month
     */
    private const GREGORIAN_MONTH_DAYS = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    /**
     * Convert current date to Sorani Kurdish calendar
     *
     * @return array
     */
    public function now(): array
    {
        return $this->convert(new DateTime());
    }

    /**
     * Convert a specific date to Sorani Kurdish calendar
     *
     * @param DateTimeInterface|string|null $date
     * @return array
     */
    public function convert($date = null): array
    {
        if ($date === null) {
            $date = new DateTime();
        } elseif (is_string($date)) {
            $date = new DateTime($date);
        }

        $gregorianYear = (int) $date->format('Y');
        $gregorianMonth = (int) $date->format('n');
        $gregorianDay = (int) $date->format('j');
        $dayOfWeek = (int) $date->format('w');

        $result = $this->gregorianToKurdish($gregorianYear, $gregorianMonth, $gregorianDay);
        
        return [
            'day' => $result['day'],
            'month' => $result['month'],
            'year' => $result['year'],
            'monthName' => $result['monthName'],
            'dayName' => $this->getDayName($dayOfWeek),
        ];
    }

    /**
     * Convert Gregorian date to Kurdish date
     *
     * @param int $gy Gregorian year
     * @param int $gm Gregorian month
     * @param int $gd Gregorian day
     * @return array
     */
    private function gregorianToKurdish(int $gy, int $gm, int $gd): array
    {
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        } else {
            $jy = 0;
            $gy -= 621;
        }

        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        
        $days = (365 * $gy) 
            + (int) floor(($gy2 + 3) / 4) 
            - (int) floor(($gy2 + 99) / 100) 
            + (int) floor(($gy2 + 399) / 400) 
            - 80 
            + $gd 
            + array_sum(array_slice(self::GREGORIAN_MONTH_DAYS, 0, $gm));

        $jy += 33 * (int) floor($days / 12053);
        $days %= 12053;
        
        $jy += 4 * (int) floor($days / 1461);
        $days %= 1461;

        $jy += (int) floor(($days - 1) / 365);
        if ($days > 365) {
            $days = ($days - 1) % 365;
        }

        $jm = ($days < 186) ? 1 + (int) floor($days / 31) : 7 + (int) floor(($days - 186) / 30);
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));

        // Add 1321 to convert to Sorani Kurdish year
        $jy += 1321;

        return [
            'day' => $jd,
            'month' => $jm,
            'year' => $jy,
            'monthName' => $this->getMonthName($jm),
        ];
    }

    /**
     * Get month name by month number
     *
     * @param int $monthNumber
     * @return string
     */
    private function getMonthName(int $monthNumber): string
    {
        return self::MONTH_NAMES[$monthNumber] ?? '';
    }

    /**
     * Get day name by day number (0-6, where 0 is Sunday)
     *
     * @param int $dayNumber
     * @return string
     */
    private function getDayName(int $dayNumber): string
    {
        return self::DAY_NAMES[$dayNumber % 7] ?? '';
    }

    /**
     * Check if a Gregorian year is a leap year
     *
     * @param int $year
     * @return bool
     */
    public function isLeapYear(int $year): bool
    {
        return ($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0);
    }

    /**
     * Format a Kurdish date
     *
     * @param array $date
     * @param string $format Available formats: 'full', 'date', 'short'
     * @return string
     */
    public function format(array $date, string $format = 'full'): string
    {
        return match ($format) {
            'full' => "{$date['dayName']}، {$date['day']} {$date['monthName']} {$date['year']}",
            'date' => "{$date['day']} {$date['monthName']} {$date['year']}",
            'short' => "{$date['day']}/{$date['month']}/{$date['year']}",
            default => "{$date['day']} {$date['monthName']} {$date['year']}",
        };
    }

    /**
     * Get all month names
     *
     * @return array
     */
    public function getMonthNames(): array
    {
        return self::MONTH_NAMES;
    }

    /**
     * Get all day names
     *
     * @return array
     */
    public function getDayNames(): array
    {
        return self::DAY_NAMES;
    }
}
