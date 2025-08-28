<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class KarierPageApiService
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

    public function getPageSettings(): ?array
    {
        return $this->httpClient->get('/karier-settings')->json();
    }

    public function updatePageSettings(array $data): Response
    {
        $request = $this->httpClient->asMultipart();
        
        $payload = $this->transformKeysToCamelCase($data);

        foreach ($payload as $key => $value) {
            if ($value instanceof UploadedFile && $value->isValid()) {
                $request->attach($key, file_get_contents($value), $value->getClientOriginalName());
            } 
            else if (!is_null($value) && !($value instanceof UploadedFile)) {
                $request->attach($key, $value);
            }
        }
        
        return $request->post('/karier-settings');
    }
}