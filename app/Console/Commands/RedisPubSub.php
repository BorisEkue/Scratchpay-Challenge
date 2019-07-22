<?php

namespace App\Console\Commands;

use App\Adapter\Interfaces\DateTimeAdapterInterface;
use App\Domain\Interfaces\SettlementDateDomainInterface;
use Illuminate\Console\Command;
use Redis;

class RedisPubSub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RedisPubSub:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Implement Pub/sub with Redis';

    private $settlementDateDomain;

    private $dateTime;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SettlementDateDomainInterface $settlementDateDomain, DateTimeAdapterInterface $dateTime)
    {
        parent::__construct();

        $this->settlementDateDomain = $settlementDateDomain;

        $this->dateTime = $dateTime;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Redis::subscribe(['BankWire'], function ($message) {
            $initialDate = $this->dateTime->parseDateTime($message->json('initialDate'));
            $delay = (int) $message->json('delay') ;

            $results = $this->settlementDateDomain->getSettlementDate($initialDate, $delay);

            echo $results;
        });
    }
}
