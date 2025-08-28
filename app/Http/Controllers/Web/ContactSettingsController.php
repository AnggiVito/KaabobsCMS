<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ContactSettingsApiService;
use Illuminate\Http\Request;

class ContactSettingsController extends Controller
{
    protected $contactApi;

    public function __construct(ContactSettingsApiService $contactApi)
    {
        $this->contactApi = $contactApi;
    }

    public function index()
    {
        return view('contact-setting.index', [
            'title' => 'Pengaturan Halaman',
            'subTitle' => 'Kelola Halaman Kontak',
            'settings' => $this->contactApi->getSettings()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'page_title' => 'required|string',
            'page_subtitle' => 'nullable|string',
            'contact_info_heading' => 'nullable|string',
            'contact_info_description' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'success_image' => 'nullable|image|max:2048',
        ]);

        $this->contactApi->updateSettings($validated);
        
        return redirect()->back()->with('success', 'Pengaturan Halaman Kontak berhasil diperbarui.');
    }
}