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
    /* public function create($date, $timezone = '')
     {
         return Carbon::create();
     }*/

    public function parse($date, $timezone = '')
    {
        return Carbon::parse($date);
    }

    public function parseDate($date, $timezone = '') : string
    {
        return Carbon::parse($date)->format('Y-m-d');

    }

    public function parseDateTime($dateTime, $timezone = '') : string
    {
        return Carbon::parse($dateTime)->format('Y-m-d\TH:i:s\Z');
    }

    public function isWeekDay($date)
    {
        return $date->isWeekday();
    }



}