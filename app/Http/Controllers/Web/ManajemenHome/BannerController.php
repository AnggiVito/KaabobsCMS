<?php

namespace App\Http\Controllers\Web\ManajemenHome;

use App\Http\Controllers\Controller;
use App\Services\HomeSettingsApiService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    protected $settingsApi;

    public function __construct(HomeSettingsApiService $settingsApi)
    {
        $this->settingsApi = $settingsApi;
    }

    public function index()
    {
        $settingsRaw = $this->settingsApi->getSettings();
        $settings = collect($settingsRaw)->pluck('settingValue', 'settingKey');

        $data = [
            'title' => 'Manajemen Home',
            'subTitle' => 'Section Banner',
            'settings' => $settings
        ];
        return view('banner.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'heroImage' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('heroImage') && $request->file('heroImage')->isValid()) {
            $this->settingsApi->updateOneSetting('heroImage', $request->file('heroImage'));
        }

        return redirect()->back()->with('success', 'Section Hero berhasil diperbarui.');
    }
}