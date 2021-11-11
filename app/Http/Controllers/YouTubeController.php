<?php

namespace App\Http\Controllers;

use App\Services\Video\Youtube;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    public $service;
    public function __construct()
    {
        $this->service = new Youtube();
    }

    public function index() {
        return view("youtube", [
            'urls' => $this->service->viewMostPopularVideo()
        ]);
    }
}
