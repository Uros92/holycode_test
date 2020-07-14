<?php


namespace App\Services;


use Google_Service_YouTube;

class Youtube extends Google
{
    protected $youtube_service;
    // Wikipedia with needed data
    protected $wikipedia;
    protected $max_results = 3;
    const COUNTRIES = ['gb', 'nl', 'de', 'fr', 'es', 'it', 'gr'];

    /**
     * Youtube constructor.
     * New Wikipedia instance with all data in it
     */
    public function __construct()
    {
        parent::__construct();

        // Wikipedia instance with all data
        $this->wikipedia = new Wikipedia();
        // set YOUTUBE client
        $this->youtube_service = new Google_Service_YouTube($this->google_client);
    }

    /**
     * @return array
     *
     * Get popular Youtube videos and merge with Wikipedia data
     */
    public function getTrendingYoutubeVideosForChosenCountriesWithWiki()
    {
        // this will be filtered array with all needed data vides from youtube sorted by countries
        $all_trending_videos_for_chosen_countries_filtered = [];

        // loop all needed countries
        foreach (self::COUNTRIES as $country) {
            // Get trending data from youtube by country
            $country_videos_results = $this->youtube_service->videos->listVideos(
                'snippet',
                ['chart' => 'mostPopular', 'regionCode' => $country, 'maxResults' => $this->max_results]
            );

            // Filter needed data and populate new array
            $array_with_only_needed_data = [];
            foreach ($country_videos_results->getItems() as $result) {
                $array_with_only_needed_data[] = [
                    'video_url' => 'https://www.youtube.com/watch?v=' . $result->id,
                    'description' => $result->snippet->description,
                    'thumbnails_medium' => [
                        'height' => $result->snippet->thumbnails->medium->height,
                        'url' => $result->snippet->thumbnails->medium->url
                    ],
                    'thumbnails_high' => [
                        'height' => $result->snippet->thumbnails->high->height,
                        'url' => $result->snippet->thumbnails->high->url
                    ]
                ];
            }

            array_push($all_trending_videos_for_chosen_countries_filtered, [
                'name' => $country,
                'country_description' => $this->wikipedia->data[$this->wikipedia->mapped_keys_from_wikipedia_pages[$country]]['extract'],
                'videos' => $array_with_only_needed_data
            ]);
        }

        return $all_trending_videos_for_chosen_countries_filtered;
    }
}
