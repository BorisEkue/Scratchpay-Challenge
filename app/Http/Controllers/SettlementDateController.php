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
}
