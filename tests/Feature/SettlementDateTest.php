<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettlementDateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test if a date is a business date
     */
    public function testIsBusinessDay()
    {
        $this->json('POST', '/api/v1/businessDates/isBusinessDay',[
                'initialDate' => "November 10 2018"
            ])
            ->assertExactJson([
                "ok" => true,
                "initialQuery" => [
                    "initialDate" => "November 10 2018"
                ],
                "results" => [
                    "isBusinessDate" => false
                ]
            ])
            ->assertStatus(200);
    }

    /**
     * Test businessDate case 1
     */
    public function testBusinessDateOne()
    {
        $this->json('POST', '/api/v1/businessDates/getSettlementDate', [
                    'initialDate' => "November 10 2018",
                    'delay' => 3
                ])
                ->assertExactJson([
                    "ok" => true,
                    "initialQuery" => [
                        "initialDate" => "November 10 2018",
                        "delay" => 3
                    ],
                    "results" => [
                        "businessDate" => "November 15th 2018",
                        "totalDays" => 5,
                        "holidayDays" => 1,
                        "weekendDays" => 2
                    ]
                ])

                ->assertStatus(200);
    }

    /**
     * Test businessDate case 2
     */
    public function testBusinessDateTwo()
    {
        $this->json('POST', '/api/v1/businessDates/getSettlementDate', [
            'initialDate' => "November 15 2018",
            'delay' => 3
        ])
            ->assertExactJson([
                "ok" => true,
                "initialQuery" => [
                    "initialDate" => "November 15 2018",
                    "delay" => 3
                ],
                "results" => [
                    "businessDate" => "November 19th 2018",
                    "totalDays" => 4,
                    "holidayDays" => 0,
                    "weekendDays" => 2
                ]
            ])

            ->assertStatus(200);
    }


    /**
     * Test businessDate case 3
     */
    public function testBusinessDateThree()
    {
        $this->json('POST', '/api/v1/businessDates/getSettlementDate', [
            'initialDate' => "December 25 2018",
            'delay' => 20
        ])
            ->assertExactJson([
                "ok" => true,
                "initialQuery" => [
                    "initialDate" => "December 25 2018",
                    "delay" => 20
                ],
                "results" => [
                    "businessDate" => "January 24th 2019",
                    "totalDays" => 30,
                    "holidayDays" => 2,
                    "weekendDays" => 8
                ]
            ])

            ->assertStatus(200);
    }




}
