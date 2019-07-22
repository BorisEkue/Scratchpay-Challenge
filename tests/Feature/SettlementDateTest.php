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
        $this->json('POST', '/api/v1/isBusinessDay/',[
                'initialDate' => "November 10 2018"
            ])
            ->assertExactJson([
                "ok" => true,
                "initialQuery" => [
                    "initialDate" => "November 10 2018",
                    "delay" => 3
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
        $this->json('POST', '/api/v1/businessDates/', [
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
                        "businessDate" => "2018-11-14T00:00:00Z",
                        "totalDays" => 4,
                        "holidayDays" => 0,
                        "weekendDays" => 1
                    ]
                ])

                ->assertStatus(200);
    }

    /**
     * Test businessDate case 2
     */
    public function testBusinessDateTwo()
    {
        $this->json('POST', '/api/v1/businessDates/', [
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
                    "businessDate" => "2018-11-20T00:00:00Z",
                    "totalDays" => 5,
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
        $this->json('POST', '/api/v1/businessDates/', [
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
                    "businessDate" => "2019-01-22T00:00:00Z",
                    "totalDays" => 28,
                    "holidayDays" => 0,
                    "weekendDays" => 8
                ]
            ])

            ->assertStatus(200);
    }




}
