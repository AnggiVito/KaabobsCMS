<?php

namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeSettingsApiService;
use App\Services\HomeItemsApiService;
use Illuminate\Http\Request;

class InfoGambarController extends Controller
{
    protected $settingsApi;
    protected $itemsApi;

    public function __construct(HomeSettingsApiService $settingsApi, HomeItemsApiService $itemsApi)
    {
        $this->settingsApi = $settingsApi;
        $this->itemsApi = $itemsApi;
    }

    public function index()
    {
        $settingsRaw = $this->settingsApi->getSettings();
        $settings = collect($settingsRaw)->pluck('settingValue', 'settingKey');
        
        $data = [
            'title' => 'Manajemen Home',
            'subTitle' => 'Section Info Gambar',
            'settings' => $settings,
            'kStarItems' => $this->itemsApi->getAll('kStar')
        ];
        return view('info-gambar.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'startOrderText' => 'nullable|string',
            'menuKiriImageBase' => 'nullable|image|max:2048',
            'menuKiriImageHover' => 'nullable|image|max:2048',
            'outletKananImage' => 'nullable|image|max:2048',
            'caraOrderImageBase' => 'nullable|image|max:2048',
            'caraOrderImageHover' => 'nullable|image|max:2048',
            'kebabMakerImageBase' => 'nullable|image|max:2048',
            'kebabMakerImageOverlay' => 'nullable|image|max:2048',
        ]);

        $allData = $request->all();

        foreach ($allData as $key => $value) {
            if ($key === '_token') {
                continue;
            }

            if ($request->hasFile($key) && $request->file($key)->isValid()) {
                $this->settingsApi->updateOneSetting($key, $request->file($key));
            } else if ($request->filled($key)) {
                $this->settingsApi->updateOneSetting($key, $request->input($key));
            }
        }

        return redirect()->back()->with('success', 'Info Gambar & Teks berhasil diperbarui.');
    }
}