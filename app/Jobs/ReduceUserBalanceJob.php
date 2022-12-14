<?php

namespace App\Jobs;

use App\Services\UserBalanceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReduceUserBalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private object $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(UserBalanceService $user_balance)
    {
        $user_balance->setUser($this->user)->reduceBalance();
    }
}