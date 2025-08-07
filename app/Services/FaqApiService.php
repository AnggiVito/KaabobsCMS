<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class FaqApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.adonis.base_url'))
                                ->acceptJson()
                                ->throw();
    }

    public function getAll(): array
    {
        $response = $this->httpClient->get('/faqs');
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/faqs/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data): Response
    {
        return $this->httpClient->post('/faqs', $data);
    }

    public function update(string $id, array $data): Response
    {
        return $this->httpClient->put("/faqs/{$id}", $data);
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/faqs/{$id}");
    }
}