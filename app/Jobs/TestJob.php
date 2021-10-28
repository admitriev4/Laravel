<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $testDate;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $testDate)
    {
        $this->testDate = $testDate;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info("Пользователь авторизован!");
        logs()->info("В job передаеться информация -> " . $this->testDate );
    }
}
