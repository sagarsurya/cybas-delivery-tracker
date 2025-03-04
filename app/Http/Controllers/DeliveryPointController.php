<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryPoint;
use Illuminate\Support\Facades\Http;

class DeliveryPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryPoints = DeliveryPoint::all();

        $data = $deliveryPoints->map(function ($point) {
            $weather = $this->fetchWeather($point->city);
            return array_merge($point->toArray(), ['weather' => $weather]);
        });

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
            'contact_person' => 'required|string',
            'contact_number' => 'nullable|numeric',
        ]);

        $deliveryPoint = DeliveryPoint::create($request->all());

        return response()->json($deliveryPoint, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $deliveryPoint = DeliveryPoint::findOrFail($id);
        $weather = $this->fetchWeather($deliveryPoint->city);

        return response()->json(array_merge($deliveryPoint->toArray(), ['weather' => $weather]));
    }

    private function fetchWeather($city)
    {
        $apiUrl = 'https://api.openweathermap.org/data/2.5/weather';
        $apiKey = env('OPENWEATHER_API_KEY');
        $url = $apiUrl."?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'temperature' => $data['main']['temp'] . ' °C',
                'condition' => $data['weather'][0]['description'],
            ];
        }

        return ['error' => 'Weather data not available'];
    }
}
