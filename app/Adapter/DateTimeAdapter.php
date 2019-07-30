<?php


namespace App\Adapter;


use App\Adapter\Interfaces\DateTimeAdapterInterface;
use Carbon\Carbon;

/**
 * The DateTimeAdapter class' purpose is to help
 * seamlessly switch from one datetime library to another
 * in the project when needed.
 * The same thing could be done with any other library
 * Class DateTimeAdapter
 * @package App\Adapter
 */
class DateTimeAdapter implements DateTimeAdapterInterface
{

    /**
     * Parse a given date
     * @param $date
     * @param string $timezone
     * @return Carbon
     */
    public function parse($date, $timezone = '')
    {
        return Carbon::parse($date);
    }

    /**
     * Parse a given date to the format Y-m-d
     * @param $date
     * @param string $timezone
     * @return string
     */
    public function parseDate($date, $timezone = '') : string
    {
        return Carbon::parse($date)->format('Y-m-d');

    }

    /**
     * Parse a given datetime to the format Y-m-d\TH:i:s\Z
     * @param $dateTime
     * @param string $timezone
     * @return string
     */
    public function parseDateTime($dateTime, $timezone = '') : string
    {
        return Carbon::parse($dateTime)->format('Y-m-d\TH:i:s\Z');
    }

    /**
     * Parse a given datetime to ISO format
     * @param $dateTime
     * @param string $timezone
     * @return string
     */
    public function parseDateIsoFormat($dateTime, $timezone = '') : string
    {
        return Carbon::parse($dateTime)->isoFormat('MMMM Do YYYY');
    }

    /**
     * Check if a given date is whether a week day or not
     * @param $date
     * @return mixed
     */
    public function isWeekDay($date)
    {
        return $date->isWeekday();
    }


}