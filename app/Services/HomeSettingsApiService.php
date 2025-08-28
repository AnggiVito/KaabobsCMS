<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;

class HomeSettingsApiService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = Http::baseUrl(config('services.adonis.base_url'))
                                ->acceptJson()
                                ->throw();
    }

    public function getSettings(): array
    {
        $response = $this->httpClient->get('/home-settings');
        return $response->json();
    }

    public function updateOneSetting(string $key, $value): Response
    {
        $request = $this->httpClient->asMultipart();

        $request->attach('settingKey', $key);

        if ($value instanceof UploadedFile && $value->isValid()) {
            $request->attach('settingFile', file_get_contents($value), $value->getClientOriginalName());
        } else if (!is_null($value)) {
            $request->attach('settingValue', $value);
        } else {
            $request->attach('settingValue', '');
        }
        return $request->post('/home-settings-update'); 
    }
}