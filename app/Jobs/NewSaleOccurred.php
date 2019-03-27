<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Nexmo;

class NewSaleOccurred implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
       $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Nexmo $nexmo)
    {
        $amount = $this->payload['data']['object']['amount'] / 100;

        $message = 'Hello, you just made a sale of $' .$amount. ' in your store';

        $number = env('PHONE_NUMBER');

        $nexmo->notify($number, $message);
    }
}
