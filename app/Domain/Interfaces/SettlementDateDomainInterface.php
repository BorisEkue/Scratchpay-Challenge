<?php


namespace App\Domain\Interfaces;


interface SettlementDateDomainInterface
{
    public function isWeekDay($date);
    public function getSettlementDate( $initialDate, int $delay, string $countryCode = 'US');
}