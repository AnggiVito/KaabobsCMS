<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;

class PromoApiService
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
        $response = $this->httpClient->get('/promos');
        return $response->json();
    }

    public function findById(string $id): ?array
    {
        $response = $this->httpClient->get("/promos/{$id}");
        return $response->successful() ? $response->json() : null;
    }

    public function create(array $data, UploadedFile $imageFile): Response
    {
        $request = $this->httpClient->asMultipart();
        
        $request->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());

        foreach ($data as $key => $value) {
            $request->attach($key, $value);
        }

        return $request->post('/promos');
    }

    public function update(string $id, array $data, ?UploadedFile $imageFile): Response
    {
        $request = $this->httpClient->asMultipart();

        if ($imageFile) {
            $request->attach('image', file_get_contents($imageFile), $imageFile->getClientOriginalName());
        }
        
        foreach ($data as $key => $value) {
            $request->attach($key, $value);
        }

        $request->attach('_method', 'PUT');

        return $request->post("/promos/{$id}");
    }

    public function delete(string $id): Response
    {
        return $this->httpClient->delete("/promos/{$id}");
    }
}