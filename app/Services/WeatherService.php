<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    }

    /**
     * Get weather data based on latitude and longitude.
     */
    public function getWeather($lat, $lon)
    {
        $response = Http::get($this->baseUrl, [
            'lat'   => $lat,
            'lon'   => $lon,
            'appid' => $this->apiKey,
            'units' => 'metric', // metric is for the temperature in Celsius
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
