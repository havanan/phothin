<?php

namespace App\Lib;

use Carbon\Carbon;
use Exception;

class DateCommon
{
    /**
     * getUtcClientDateFromInDay
     * @param string $day
     * @return Carbon UTC
     */
    public static function getUtcClientDateFromInDay($day)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        return Carbon::parse($day, $timezone)
            ->setHour(0)
            ->setMinute(0)
            ->setSecond(0)
            ->utc();
    }

    /**
     * getUtcClientDateToInDay
     * @param string $day
     * @return Carbon UTC
     */
    public static function getUtcClientDateToInDay($day)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        return Carbon::parse($day, $timezone)
            ->setHour(23)
            ->setMinute(59)
            ->setSecond(59)
            ->utc();
    }

    /**
     * getUtcClientFirstOfMonth
     * @param string $day
     * @return Carbon UTC
     */
    public static function getUtcClientFirstOfMonth($day)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        return Carbon::parse($day, $timezone)
            ->firstOfMonth()
            ->setHour(0)
            ->setMinute(0)
            ->setSecond(0)
            ->utc();
    }

    /**
     * getUtcClientLastOfMonth
     * @param string $day
     * @return Carbon UTC
     */
    public static function getUtcClientLastOfMonth($day)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        return Carbon::parse($day, $timezone)
            ->lastOfMonth()
            ->setHour(23)
            ->setMinute(59)
            ->setSecond(59)
            ->utc();
    }

    /**
     * getUtcClientCurrentTime
     * @param string $datetime
     * @return Carbon UTC
     */
    public static function getUtcClientCurrentTime($datetime)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        if (empty($timezone)) return '';
        return Carbon::parse($datetime, $timezone)
            ->utc();
    }

    /**
     * getUtcClientCurrentTime
     * @param string $datetime
     * @return Carbon UTC
     */
    public static function getUTCLastTimeDayFromDate($datetime)
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        return Carbon::parse($datetime, $timezone)
            ->setHour(23)
            ->setMinute(59)
            ->setSecond(59)
            ->utc();
    }

    /**
     * isValidTimezone
     *
     * @param  mixed $timezone
     * @return void
     */
    public static function isValidTimezone($timezone)
    {
        try {
            if (empty($timezone)) {
                return false;
            }
            return Carbon::now()->setTimeZone($timezone);
        } catch (Exception $ex) {
            return false;
        }
    }


    /**
     * getCurrentTimeClient
     * @param string $datetime
     * @return Carbon UTC
     */
    public static function getCurrentTimeClient($datetime = "")
    {
        $timezone = request()->header('X-Application-Timezone') ?? 'UTC';
        if (empty($timezone)) return '';

        $datetime = !empty($datetime) ? $datetime : Carbon::now($timezone)->format(FORMAT_DATETIME);
        return Carbon::parse($datetime, $timezone);
    }
}
