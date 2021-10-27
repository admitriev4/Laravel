<?php
namespace App\Services\Video;

class Youtube
{
    protected $rand;

    public function __construct()
    {
        $this->rand = rand(0, 1000);
    }
    public function main() {
        return $this->rand;
    }


}
