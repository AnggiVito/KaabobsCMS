<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class HomeItemsApiService
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
        $response = $this->httpClient->get('/home-items', ['item_type' => $itemType]);
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/home-items/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data, UploadedFile $imageFile): Response
    {
        $payload = $this->transformKeysToCamelCase($data);
        $request = $this->httpClient->asMultipart()->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());

        foreach ($payload as $key => $value) {
            if (!is_null($value)) {
                $request->attach($key, $value);
            }
        }
        return $request->post('/home-items');
    }

    public function update(string $id, array $data, ?UploadedFile $imageFile): Response
    {
        $payload = $this->transformKeysToCamelCase($data);
        $request = $this->httpClient->asMultipart()->attach('_method', 'PUT');

        if ($imageFile) {
            $request->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());
        }
        
        foreach ($payload as $key => $value) {
            if (!is_null($value)) {
                $request->attach($key, $value);
            }
        }
        
        return $request->post("/home-items/{$id}");
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/home-items/{$id}");
    }
}