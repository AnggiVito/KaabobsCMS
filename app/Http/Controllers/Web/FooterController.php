<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\FooterApiService;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    protected $footerApi;

    public function __construct(FooterApiService $footerApi)
    {
        $this->footerApi = $footerApi;
    }

    public function index()
    {
        $settings = $this->footerApi->getSettings();

        $settings['navLinks'] = $settings['navLinks'] ?? [];
        $settings['socialMediaLinks'] = $settings['socialMediaLinks'] ?? [];
        return view('footer.index', [
            'title' => 'Pengaturan Website',
            'subTitle' => 'Pengaturan Footer',
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'logo_image' => 'nullable|image|max:2048',
            'company_name' => 'nullable|string',
            'company_address' => 'nullable|string',
            'company_email' => 'nullable|email',
            'company_phone' => 'nullable|string',
            'sign_up_text' => 'nullable|string',
            'nav_links.*.label' => 'nullable|string',
            'nav_links.*.route' => 'nullable|string',
            'social_media_links.*.name' => 'nullable|string',
            'social_media_links.*.url' => 'nullable|url',
        ]);
        
        $dataToUpdate = $request->except(['_token', 'logoImage', 'nav_links', 'social_media_links']);

        if ($request->has('nav_links')) {
            $navLinks = array_filter($request->nav_links, fn($link) => !empty($link['label']) && !empty($link['route']));
            $dataToUpdate['nav_links'] = json_encode(array_values($navLinks));
        }

        if ($request->has('social_media_links')) {
            $socialLinks = array_filter($request->social_media_links, fn($link) => !empty($link['name']) && !empty($link['url']));
            $dataToUpdate['social_media_links'] = json_encode(array_values($socialLinks));
        }

        $this->footerApi->updateSettings($dataToUpdate);

        return redirect()->back()->with('success', 'Footer berhasil diperbarui.');
    }
}