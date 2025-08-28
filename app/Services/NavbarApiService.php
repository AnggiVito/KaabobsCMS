<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class NavbarApiService
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

    public function getAll(string $itemType): array
    {
        return $this->httpClient->get('/navbar-items', ['item_type' => $itemType])->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/navbar-items/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data, ?UploadedFile $imageFile): Response
    {
        $payload = $this->transformKeysToCamelCase($data);
        $request = $this->httpClient->asMultipart();

        if ($imageFile) {
            $request->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());
        }

        foreach ($payload as $key => $value) {
            if (!is_null($value)) {
                $request->attach($key, (string)$value);
            }
        }
        return $request->post('/navbar-items');
    }

    public function update(string $id, array $data, ?UploadedFile $imageFile): Response
    {
        $payload = $this->transformKeysToCamelCase($data);
        $request = $this->httpClient->asMultipart();

        if ($imageFile) {
            $request->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());
        }
        
        foreach ($payload as $key => $value) {
            if (!is_null($value)) {
                $request->attach($key, (string)$value);
            }
        }
        
        return $request->post("/navbar-items/{$id}");
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/navbar-items/{$id}");
    }
}