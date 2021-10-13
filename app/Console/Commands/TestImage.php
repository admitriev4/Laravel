<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class TestImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images-load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info("hello word!");
        /*$users = DB::table('users')->select('id', 'name', 'last_name')->get();
        $array_users = $users->map(function ($item, $key) {
            return (array) $item;
        });
        $this->table(['id', 'name', 'last_name'], $array_users);*/
        $urlImage = "https://s3.eu-north-1.amazonaws.com/yelm.io.2/files/EZddxIgQwuXkhUmR61fw1V20c9TAh5pIboQUYA12.png";
        $image = file_get_contents($urlImage);
        var_dump($image);
        $this->info("end");
    }
}
