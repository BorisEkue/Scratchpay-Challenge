<?php


namespace App\Adapter;


use App\Adapter\Interfaces\DateTimeAdapterInterface;
use Carbon\Carbon;

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