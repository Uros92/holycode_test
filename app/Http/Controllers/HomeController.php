<?php

namespace App\Http\Controllers;

use App\Services\Youtube;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class HomeController extends Controller
{
    /**
     * Home page url
     */
    public function index()
    {
        //Cache::forget('youtube_videos_trending');

        return view('index');
    }

    /**
     * Get youtube and wikipedia data merged and return json
     *
     * @return mixed
     */
    public function results(Request $request)
    {
        // Cache youtube results and return json
        $results = Cache::remember('youtube_videos_trending', Carbon::now()->addMinutes(120), function () {
            return (new Youtube())->getTrendingYoutubeVideosForChosenCountriesWithWiki();
        });

        // Check if offset nad limits exists in request
        if($request->limit && $request->offset) {
            $results = array_slice($results, $request->offset, $request->limit);
        }

        return $results;
    }
}
