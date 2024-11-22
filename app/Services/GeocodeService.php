<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodeService
{
    public function getCoordinates(string $state, string $city): array
    {
        $address = $city . ', ' . $state;

        // Obtén la clave de API del archivo .env (opcional si la API lo requiere)
        $apiKey = config('services.geocode.api_key');

        // Realiza la solicitud a la API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get("https://geocode.maps.co/search", [
            'q' => $address,
        ]);

        // Manejo de respuesta
        if ($response->successful() && count($response->json()) > 0) {
            $location = $response->json()[0];
            return [
                'latitude' => $location['lat'],
                'longitude' => $location['lon'],
            ];
        }

        // Si no se encuentran resultados, devuelve valores nulos
        return [
            'latitude' => null,
            'longitude' => null,
        ];
    }
}
