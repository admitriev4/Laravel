<?php
namespace App\Services\Video;

class Youtube
{
    protected $apiKey;


    public function __construct()
    {
        $this->apiKey = "AIzaSyDcMLE1Mlc99cBOpBm0_0OmJaV56MvbXCY";
    }
    public function viewMostPopularVideo() {
        $url = "https://www.googleapis.com/youtube/v3/videos?key=" . $this->apiKey ."&chart=mostPopular";
        $urls = array();
        $json_result = file_get_contents ($url);
        $res = json_decode($json_result);
        foreach ($res->items as $item) {
            $urls[] = "http://www.youtube.com/embed/$item->id";
        }
        /*$url = "http://www.youtube.com/embed/$video_id?enablejsapi=1&origin=http://example.com";*/
        return $urls;

    }


}
