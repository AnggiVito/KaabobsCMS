<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\KarierPageApiService;
use Illuminate\Http\Request;

class KarierPageController extends Controller
{
    protected $karierPageApi;

    public function __construct(KarierPageApiService $karierPageApi)
    {
        $this->karierPageApi = $karierPageApi;
    }

    public function index()
    {
        return view('karier.pengaturan-karier', [
            'title' => 'Pengaturan Karier',
            'subTitle' => 'Kelola Halaman Karier',
            'settings' => $this->karierPageApi->getPageSettings()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'header_title' => 'required|string',
            'header_desc1' => 'required|string',
            'header_desc2' => 'required|string',
            'header_image' => 'nullable|image|max:2048',
            'section_title' => 'required|string',
        ]);

        $this->karierPageApi->updatePageSettings($validated);
        
        return redirect()->back()->with('success', 'Halaman Karier berhasil diperbarui.');
    }
}