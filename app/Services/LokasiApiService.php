<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class LokasiApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.adonis.base_url'))
                                ->acceptJson()
                                ->throw();
    }
    private function mapLaravelToAdonis(array $data): array
    {
        $payload = [];
        foreach ($data as $key => $value) {
            $payload[Str::camel($key)] = $value;
        }
        return $payload;
    }

    public function getAll(array $filters = []): array
    {
        $response = $this->httpClient->get('/locations', $filters);
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/locations/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data): Response
    {
        $payload = $this->mapLaravelToAdonis($data);
        return $this->httpClient->post('/locations', $payload);
    }

    public function update(string $id, array $data): Response
    {
        $payload = $this->mapLaravelToAdonis($data);
        return $this->httpClient->put("/locations/{$id}", $payload);
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/locations/{$id}");
    }
}