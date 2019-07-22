<?php


namespace App\Adapter\Interfaces;


interface DateTimeAdapterInterface
{
    public function parseDate($date, $timezone);
    public function parseDateTime($dateTime, $timezone);
    public function isWeekDay($dateTime);


}