<?php


namespace App\Domain;


use App\Adapter\Interfaces\DateTimeAdapterInterface;
use App\Domain\Interfaces\SettlementDateDomainInterface;

class SettlementDateDomain implements SettlementDateDomainInterface
{
    private $dateTime;

    public function __construct(DateTimeAdapterInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * Return if a date is a week day or not
     * @param $date
     * @return mixed
     */
    public function isWeekDay($date)
    {
        return $this->dateTime->isWeekDay($date) ;
    }


    /**
     * Return if a date is a holiday or not
     * considering a specific country code
     * @param $date
     * @param string $countryCode
     * @return bool
     */
    public function isHoliday($date, string $countryCode = 'US')
    {
        $countryHolidays = $this->getCountryHolidays($countryCode);

        return in_array( $this->dateTime->parseDate($date), $countryHolidays);

    }

    /**
     * Returns bank holidays by country code.
     * Sources : https://www.interstatecapital.com/us-bank-holidays/, https://www.officeholidays.com/countries/usa/2018
     * @param $countryCode
     * @return array
     */
    private function getCountryHolidays($countryCode)
    {

        switch ($countryCode)
        {
            case 'US':
                $holidays = [
                    $this->dateTime->parseDate('2018-01-01'),
                    $this->dateTime->parseDate('2018-01-15'),
                    $this->dateTime->parseDate('2018-02-19'),
                    $this->dateTime->parseDate('2018-05-28'),
                    $this->dateTime->parseDate('2018-07-04'),
                    $this->dateTime->parseDate('2018-09-03'),
                    $this->dateTime->parseDate('2018-10-08'),
                    $this->dateTime->parseDate('2018-11-12'),
                    $this->dateTime->parseDate('2018-11-22'),
                    $this->dateTime->parseDate('2018-12-25'),

                    $this->dateTime->parseDate('2019-01-01'),
                    $this->dateTime->parseDate('2019-01-21'),
                    $this->dateTime->parseDate('2019-02-18'),
                    $this->dateTime->parseDate('2019-05-27'),
                    $this->dateTime->parseDate('2019-07-04'),
                    $this->dateTime->parseDate('2019-09-02'),
                    $this->dateTime->parseDate('2019-10-14'),
                    $this->dateTime->parseDate('2019-11-11'),
                    $this->dateTime->parseDate('2019-11-28'),
                    $this->dateTime->parseDate('2019-12-25'),


                    $this->dateTime->parseDate('2020-01-01'),
                    $this->dateTime->parseDate('2020-01-20'),
                    $this->dateTime->parseDate('2020-02-17'),
                    $this->dateTime->parseDate('2020-05-25'),
                    $this->dateTime->parseDate('2020-07-03'),
                    $this->dateTime->parseDate('2020-09-07'),
                    $this->dateTime->parseDate('2020-10-12'),
                    $this->dateTime->parseDate('2020-11-11'),
                    $this->dateTime->parseDate('2020-11-26'),
                    $this->dateTime->parseDate('2020-12-25')


                ];
                break;

            default:
                $holidays = [];
        }

        return $holidays;
    }

    /**
     * Returns the settlement date given an initial date and a delay
     * @param $initialDate
     * @param int $delay
     * @param string $countryCode
     * @return array
     */
    public function getSettlementDate( $initialDate, int $delay, string $countryCode = 'US')
    {

        $initialDate = $this->dateTime->parse($initialDate);


        (int) $totalDays = 0;
        (int) $holidays = 0;
        (int) $weekendDays = 0;
        (int) $i = 0;
        $nextDay = $initialDate;

        while($i < $delay)
        {
            //

            if(!$nextDay->isWeekDay())  {
                $weekendDays++;
            }
            if($this->isHoliday($nextDay))  {
                $holidays++;
            }
            if($nextDay->isWeekDay() && !$this->isHoliday($nextDay))
            {
                $i++;
            }


            if( ($i + 1) <= $delay) {
                $totalDays++;
                $nextDay = $nextDay->addDay();
            }

        }


        return [
            'nextDay' => $nextDay,
            'totalDays' => $totalDays,
            'weekendDays' => $weekendDays,
            'holidays' => $holidays
        ];
    }
}