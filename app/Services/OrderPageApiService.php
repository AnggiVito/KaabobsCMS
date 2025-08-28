<?php
namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class OrderPageApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.adonis.base_url'))
                                ->acceptJson()
                                ->throw();
    }
    
    public function getPageSettings(): ?array
    {
        return $this->httpClient->get('/order-settings')->json();
    }

    public function updatePageSettings(array $data): Response
    {
        $request = $this->httpClient->asMultipart();

        $this->buildMultipart($request, $data);

        return $request->post('/order-settings');
    }

    private function buildMultipart($request, array $data, string $prefix = ''): void
    {
        foreach ($data as $key => $value) {
            $newKey = $prefix ? "{$prefix}[{$key}]" : $key;

            if (is_array($value)) {
                $this->buildMultipart($request, $value, $newKey);
            } elseif ($value instanceof UploadedFile) {
                $request->attach($newKey, $value->get(), $value->getClientOriginalName());
            } elseif (!is_null($value)) {
                $request->attach($newKey, (string) $value);
            }
        }
    }
}