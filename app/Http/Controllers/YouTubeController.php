<?php

namespace App\Http\Controllers;

use App\Services\Video\Youtube;
use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    public function index(Youtube $service) {
        return view("youtube", [
            'service' => $service
        ]);
    }
}
