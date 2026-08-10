<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GeocodeService
{
    /** @var array<string, array{0: float, 1: float}> */
    private array $moroccoCities = [
        'casablanca' => [33.5731, -7.5898],
        'rabat' => [34.0209, -6.8416],
        'sale' => [34.0531, -6.7985],
        'salé' => [34.0531, -6.7985],
        'fes' => [34.0181, -5.0078],
        'fès' => [34.0181, -5.0078],
        'meknes' => [33.8935, -5.5473],
        'meknès' => [33.8935, -5.5473],
        'marrakech' => [31.6295, -7.9811],
        'tanger' => [35.7595, -5.8340],
        'agadir' => [30.4278, -9.5981],
        'oujda' => [34.6814, -1.9086],
        'kenitra' => [34.2610, -6.5802],
        'kénitra' => [34.2610, -6.5802],
        'tetouan' => [35.5889, -5.3626],
        'tétouan' => [35.5889, -5.3626],
        'safi' => [32.2994, -9.2372],
        'el jadida' => [33.2316, -8.5007],
        'nador' => [35.1688, -2.9273],
        'beni mellal' => [32.3373, -6.3498],
        'béni mellal' => [32.3373, -6.3498],
        'khouribga' => [32.8811, -6.9063],
        'settat' => [33.0010, -7.6166],
        'mohammedia' => [33.6861, -7.3829],
        'larache' => [35.1932, -6.1557],
        'essaouira' => [31.5085, -9.7595],
        'errachidia' => [31.9314, -4.4260],
        'ouarzazate' => [30.9335, -6.9370],
        'taza' => [34.2100, -4.0100],
        'ifez' => [34.0181, -5.0078],
    ];

    /**
     * @return array{lat: float, lng: float}|null
     */
    public function fromVille(?string $ville): ?array
    {
        if (! $ville || ! trim($ville)) {
            return null;
        }

        $key = Str::lower(trim($ville));
        $key = str_replace(['é', 'è', 'ê', 'à', 'ù', 'ô'], ['e', 'e', 'e', 'a', 'u', 'o'], $key);

        foreach ($this->moroccoCities as $city => $coords) {
            $normalizedCity = str_replace(['é', 'è', 'ê', 'à', 'ù', 'ô'], ['e', 'e', 'e', 'a', 'u', 'o'], $city);
            if ($key === $normalizedCity || str_contains($key, $normalizedCity) || str_contains($normalizedCity, $key)) {
                return ['lat' => $coords[0], 'lng' => $coords[1]];
            }
        }

        try {
            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => 'HorizonPost/1.0 (admin@horizonpost.a2spr.com)',
                    'Accept-Language' => 'fr',
                ])
                ->get('https://nominatim.openstreetmap.org/search', [
                    'format' => 'json',
                    'limit' => 1,
                    'countrycodes' => 'ma',
                    'q' => trim($ville) . ', Morocco',
                ]);

            if ($response->successful()) {
                $first = $response->json('0');
                if (is_array($first) && isset($first['lat'], $first['lon'])) {
                    return [
                        'lat' => (float) $first['lat'],
                        'lng' => (float) $first['lon'],
                    ];
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Geocode failed for ville: '.$ville, ['error' => $e->getMessage()]);
        }

        return null;
    }
}
