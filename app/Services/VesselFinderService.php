<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VesselFinderService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.vesselfinder.com';

    public function __construct()
    {
        $this->apiKey = env('VESSELFINDER_API_KEY');
    }

    public function getVessel($mmsi)
    {
        if (!$this->apiKey) {
            Log::error('VESSELFINDER_API_KEY tidak ditemukan');
            return null;
        }

        try {
            // Coba endpoint dengan format yang benar
            $response = Http::timeout(15)->get($this->baseUrl . '/vessels', [
                'userkey' => $this->apiKey,
                'mmsi' => $mmsi,
                'format' => 'json'
            ]);

            Log::info('VesselFinder response status: ' . $response->status());

            if ($response->successful()) {
                $data = $response->json();
                Log::info('VesselFinder data: ', ['data' => $data]);
                return $data;
            } else {
                Log::error('VesselFinder error: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            Log::error('VesselFinder exception: ' . $e->getMessage());
            return null;
        }
    }

    public function getVesselPosition($mmsi)
    {
        if (!$this->apiKey) {
            return null;
        }

        try {
            $response = Http::timeout(15)->get($this->baseUrl . '/vessels/positions', [
                'userkey' => $this->apiKey,
                'mmsi' => $mmsi,
                'format' => 'json'
            ]);

            if ($response->successful()) {
                return $response->json();
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}