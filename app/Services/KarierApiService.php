<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;

class KarierApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.adonis.base_url'))
                                ->acceptJson()
                                ->throw();
    }

    private function transformKeysToCamelCase(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[Str::camel($key)] = $value;
        }
        return $result;
    }

    public function getAll(array $filters = []): array
    {
        $response = $this->httpClient->get('/kariers', $filters);
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/kariers/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data): Response
    {
        $payload = [
            'posting' => $data['posting'],
            'namaposisi' => $data['namaposisi'],
            'kota' => $data['kota'],
            'provinsi' => $data['provinsi'],
            'workplace' => $data['workplace'],
            'worktype' => $data['worktype'],
            'paytype' => $data['paytype'],
            'deskripsi' => $data['deskripsi'],
            'payrangeFrom' => $data['payrangeFrom'] ?? null,
            'payrangeTo' => $data['payrangeTo'] ?? null,
            'jobSummary' => $data['jobSummary'],
            'jobRequirement' => $data['jobRequirement'],
        ];
        return $this->httpClient->post('/kariers', $payload);
    }

    public function update(string $id, array $data): Response
    {
        $payload = $this->transformKeysToCamelCase($data);
        return $this->httpClient->put("/kariers/{$id}", $payload);
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/kariers/{$id}");
    }
}