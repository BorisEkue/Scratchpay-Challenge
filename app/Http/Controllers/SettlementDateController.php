<?php

namespace App\Http\Controllers;

use App\Adapter\Interfaces\DateTimeAdapterInterface;

use App\Domain\Interfaces\SettlementDateDomainInterface;
use Illuminate\Http\Request;

class SettlementDateController extends Controller
{
    private $settlementDateDomain;

    private $dateTime;

    public function __construct(SettlementDateDomainInterface $settlementDateDomain, DateTimeAdapterInterface $dateTime)
    {
        $this->settlementDateDomain = $settlementDateDomain;
        $this->dateTime = $dateTime;
    }

    public function isBusinessDay(Request $request)
    {

        $initialDate = $this->dateTime->parse($request->json('initialDate'));
        $isWeekDay = $this->settlementDateDomain->isWeekDay($initialDate);
        $isHoliday = $this->settlementDateDomain->isHoliday($this->dateTime->parseDate($request->json('initialDate')), 'US');



        return response()->json(
            [
                'ok' => true,
                'initialQuery' => $request->json()->all(),
                'results' => [
                    'isBusinessDate' => ( $isWeekDay && !$isHoliday )

                ]
            ], 200);
    }

    public function getSettlementDate(Request $request)
    {

        $initialDate = $this->dateTime->parseDateTime($request->json('initialDate'));

        $delay = (int) $request->json('delay') ;

        $results = $this->settlementDateDomain->getSettlementDate($initialDate, $delay);


        return response()->json(
            [
                'ok' => true,
                'initialQuery' => $request->json()->all(),
                'results' => [
                    'businessDate' => $this->dateTime->parseDateTime($results['nextDay']) ,
                    'totalDays' => $results['totalDays'],
                    'holidayDays' => $results['holidays'],
                    'weekendDays' => $results['weekendDays']
                ]
            ], 200);
    }
}
