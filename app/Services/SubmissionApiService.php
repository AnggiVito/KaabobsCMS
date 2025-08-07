<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SubmissionApiService
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
        $response = $this->httpClient->get('/submissions');
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/submissions/{$id}");
        return $response->successful() ? $response->json() : null;
    }
}